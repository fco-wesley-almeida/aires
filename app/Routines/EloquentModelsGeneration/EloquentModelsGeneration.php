<?php


namespace App\Routines\EloquentModelsGeneration;


use App\Src\Data\Databases\AiresDb;
use Exception;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;

class EloquentModelsGeneration
{
    public const NAMESPACE = 'App\Src\Domain\EloquentModels';
    public const EXTENDS = 'Model';

    private function mapperSchemaModel(): callable
    {
        return function (array $row): ColumnSchemaModel
        {
            $schemaModel = new ColumnSchemaModel();
            $schemaModel->tableName = $row['TABLE_NAME'];
            $schemaModel->columnName = $row['COLUMN_NAME'];
            $schemaModel->ordinalPosition = $row['ORDINAL_POSITION'];
            $schemaModel->isNullable = $row['IS_NULLABLE'];
            $schemaModel->dataType = $this->mapType($row['DATA_TYPE']);
            $schemaModel->columnKey = $row['COLUMN_KEY'];
            $schemaModel->extra = $row['EXTRA'];
            return $schemaModel;
        };
    }

    public static function snakeCaseToCamelCase(string $string)
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

            echo "Connecting to database..." . PHP_EOL;
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
            echo "Reading query result..." . PHP_EOL;
            $tablesObjList = $db->getResultArray($this->mapperSchemaModel());
            return $tablesObjList;
        } catch (Exception $exception){
            echo $exception->getMessage() . PHP_EOL;
            echo "Error on connection to database." . PHP_EOL;
            return new Collection();
        }
    }

    private function mapType(string $type): string
    {
        $types = [
            'int' => 'int',
            'varchar' => 'string',
            'decimal' => 'float',
            'float' => 'float',
            'char' => 'float',
            'bool' => 'bool',
            'blob' => 'string',
            'text' => 'string',
            'date' => 'string',
            'time' => 'string',
            'year' => 'string',
            'double' => 'float',
            'datetime' => 'string',
        ];
        return $types[$type];
    }

    private function tables(Collection $columns): Collection
    {
        echo "Mapping query result..." . PHP_EOL;
        $tables = new Collection();
        $j = 0;
        $columns->each(function (ColumnSchemaModel $column) use (&$tables, &$j)
        {
            if ($j === 0 || $tables->get($j - 1)->name !== $column->tableName)
            {
                echo "Mapping table {$column->tableName}..." . PHP_EOL;
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

    private function generateFiles(Collection $tables)
    {
        $tables->each(function (TableSchemaModel $table)
        {
            $dir = __DIR__ .  '/EloquentModels/' . ucfirst(self::snakeCaseToCamelCase($table->name) . '.php');
            echo "Create class of table \"{$table->name}\" on $dir." . PHP_EOL;
            $file = fopen($dir, 'w');
            fwrite($file, $table->generateClass());
            fclose($file);
        });
    }

    public function run(): void
    {
        $columns = $this->schema();
        $tables = $this->tables($columns);
        $this->generateFiles($tables);
    }
}
