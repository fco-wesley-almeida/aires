<?php


namespace App\Routines\EloquentModelsGeneration;


use Illuminate\Support\Collection;

class TableSchemaModel
{
    public string $name;
    public Collection $columns;
    public function generateClass(): string
    {
        $name = $this->name;
        $columns = $this->columns->toArray();
        $data = [$name, $columns];
        extract($data);
        ob_start();
        include 'classModel.php';
        return ob_get_clean();
    }
}
