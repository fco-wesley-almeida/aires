<?php


namespace App\Routines\EloquentModelsGeneration;


use Illuminate\Support\Collection;

class TableSchemaModel
{
    public string $name;
    public Collection $columns;
    public Collection $relations;
    public function generateClass(): string
    {
        $name = $this->name;
        $columns = $this->columns->toArray();
        $relations = $this->relations->toArray();
        $data = [$name, $columns, $relations];
        extract($data);
        ob_start();
        include 'classModel.php';
        return ob_get_clean();
    }
}
