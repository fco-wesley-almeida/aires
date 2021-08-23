<?php


namespace App\Routines\EloquentModelsGeneration;


use App\Src\Data\Databases\AiresDb;
use Exception;
use Illuminate\Support\Collection;

class EloquentModelsGeneration
{
    public const NAMESPACE = 'App\Src\Domain\EloquentModels';
    public const EXTENDS = 'EloquentModel';

    private function mapperSchemaModel(): callable
    {
        return function (array $row): ColumnSchemaModel {
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

    private function mapperRelationSchemaModel(): callable
    {
        return function (array $row): RelationSchemaModel {
            $schemaModel = new RelationSchemaModel();
            $schemaModel->fatherTable = $row['fatherTable'];
            $schemaModel->sonTable = $row['sonTable'];
            $schemaModel->isUnique = (bool)$row['isUnique'];
            return $schemaModel;
        };
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
        } catch (Exception $exception) {
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
        $columns->each(function (ColumnSchemaModel $column) use (&$tables, &$j) {
            if ($j === 0 || $tables->get($j - 1)->name !== $column->tableName) {
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

    private function generateFiles(Collection $tables, Collection $relations)
    {
        $tables->each(function (TableSchemaModel $table) use ($relations) {
            $table->relations = new Collection();
            $relations->each(function (RelationSchemaModel $relation) use ($table) {
               if ($table->name === $relation->fatherTable) {
                   $table->relations->add($relation);
               }
            });
            $dir = __DIR__ . '/EloquentModels/' . ucfirst(StringUtils::snakeCaseToCamelCase($table->name) . '.php');
            echo "Create class of table \"{$table->name}\" on $dir." . PHP_EOL;
            $file = fopen($dir, 'w');
            fwrite($file, $table->generateClass());
            fclose($file);
        });
    }

    public function getRelations(): Collection
    {
        $db = new AiresDb();
        echo "Getting relations..." . PHP_EOL;
        try {
            echo "Connecting to database..." . PHP_EOL;
            $db->connect();
            $sql = <<<SQL
                select
                    rc.REFERENCED_TABLE_NAME as fatherTable,
                    rc.TABLE_NAME sonTable,
                    (
                        select
                            if (count(*) > 0, 1, 0)
                        from information_schema.TABLE_CONSTRAINTS tc
                        inner join information_schema.KEY_COLUMN_USAGE kcu on kcu.CONSTRAINT_NAME = tc.CONSTRAINT_NAME
                        where 1
                              and tc.CONSTRAINT_TYPE = 'UNIQUE'
                              -- and tc.CONSTRAINT_SCHEMA = 'aires'
                              and kcu.COLUMN_NAME = kc.COLUMN_NAME
                              and kcu.TABLE_NAME = rc.TABLE_NAME
                    ) as isUnique
                from information_schema.KEY_COLUMN_USAGE kc
                inner join information_schema.REFERENTIAL_CONSTRAINTS rc on rc.CONSTRAINT_NAME = kc.CONSTRAINT_NAME
                order by rc.REFERENCED_TABLE_NAME, rc.TABLE_NAME
            SQL;
            $db->query($sql);
            echo "Reading query result..." . PHP_EOL;
            $tablesObjList = $db->getResultArray($this->mapperRelationSchemaModel());
//            for ($i = 1; $i < $tablesObjList->count(); $i++)
//            {
//                for ($j = $i; $j >= 0; $j--)
//                {
//                   if ($tablesObjList[$i]->)
//                }
//            }
            return $tablesObjList;
        } catch (Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;
            echo "Error on connection to database." . PHP_EOL;
            return new Collection();
        }

    }

    public function run(): void
    {
        $columns = $this->schema();
        $tables = $this->tables($columns);
        $relations = $this->getRelations();
        $this->generateFiles($tables, $relations);
    }
}
