<?php


namespace App\Routines\EloquentModelsGeneration;


use App\Src\Data\Databases\AiresDb;
use Exception;
use Illuminate\Support\Collection;

class EloquentModelsGeneration
{
    private string $namespace = 'App\Src\Domain\EloquentModels';
    private string $extends = 'Model';

    private function mapperSchemaModel(): callable
    {
        return function (array $row): ColumnSchemaModel
        {
            $schemaModel = new ColumnSchemaModel();
            $schemaModel->tableName = $row['TABLE_NAME'];
            $schemaModel->columnName = $row['COLUMN_NAME'];
            $schemaModel->ordinalPosition = $row['ORDINAL_POSITION'];
            $schemaModel->isNullable = $row['IS_NULLABLE'];
            $schemaModel->dataType = $row['DATA_TYPE'];
            $schemaModel->columnKey = $row['COLUMN_KEY'];
            $schemaModel->extra = $row['EXTRA'];
            return $schemaModel;
        };
    }

    private function snakeCaseToCamelCase(string $string)
    {
            $camelCaseAttrName = ucfirst(strtolower($string));
            $underscorePositions = [];
            $len = strlen($camelCaseAttrName);
            for ($i = 0; $i < $len; $i++) {
                if ($camelCaseAttrName[$i] === '_') {
                    $underscorePositions[] = $i;
                }
            }
            foreach ($underscorePositions as $underscorePos) {
                $camelCaseAttrName[$underscorePos + 1] = strtoupper($camelCaseAttrName[$underscorePos + 1]);
            }
            $camelCaseAttrName = str_replace('_', '', $camelCaseAttrName);
            return $camelCaseAttrName;
    }

    private function schema(): Collection
    {
        $db = new AiresDb();

        try {
            $db->connect();

            $sql = <<<SQL
                SELECT
                    TABLE_NAME,
                    COLUMN_NAME,
                    ORDINAL_POSITION,
                    IS_NULLABLE,
                    DATA_TYPE,
                    COLUMN_KEY,
                    EXTRA
                FROM information_schema.COLUMNS C
                WHERE
                      C.TABLE_SCHEMA = :dbName
            SQL;
            $binds = ['dbName' => $db->getDatabase()];
            $db->query($sql, $binds);
            $tablesObjList = $db->getResultArray($this->mapperSchemaModel());
            return $tablesObjList;
        } catch (Exception $exception){
            echo "Error on connection to database.";
            return new Collection();
        }
    }


    private function tables(Collection $columns): Collection
    {
        $tables = new Collection();
        $j = 0;
        $columns->each(function (ColumnSchemaModel $column) use (&$tables, &$j)
        {
            if ($j === 0 || $tables->get($j - 1)->name !== $column->tableName)
            {
                $table = new TableSchemaModel();
                $table->name = $column->tableName;
                $table->columns = new Collection();
                $table->columns->add($column);
                $tables->add($table);
                $j++;
                return;
            }
            $tables->get($j - 1)->columns->add($column);
        });
        return $tables;
    }

    public function run(): void
    {
        $columns = $this->schema();
        $tables = $this->tables($columns);
        $tables->each(function (TableSchemaModel $table)
        {
            echo $table->generateClass();
        });
    }
}
