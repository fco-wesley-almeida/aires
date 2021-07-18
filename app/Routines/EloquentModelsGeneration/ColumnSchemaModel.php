<?php


namespace App\Routines\EloquentModelsGeneration;


class ColumnSchemaModel
{
    public string $tableName;
    public string $columnName;
    public int $ordinalPosition;
    public bool $isNullable;
    public string $dataType;
    public string $columnKey;
    public string $extra;
}
