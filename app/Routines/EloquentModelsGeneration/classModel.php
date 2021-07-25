<?php

use App\Routines\EloquentModelsGeneration\ColumnSchemaModel;
use App\Routines\EloquentModelsGeneration\EloquentModelsGeneration;

if (isset($columns)) {
    $columns = collect($columns);
}

$tab = "    ";

echo '<?php' . PHP_EOL;
?>

namespace <?= EloquentModelsGeneration::NAMESPACE?>;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
<?php
    $columns->each(function (ColumnSchemaModel $column) {
       echo " * @property {$column->dataType} \${$column->columnName}" . PHP_EOL;
    });
?>
*/
class <?= ucfirst(EloquentModelsGeneration::snakeCaseToCamelCase($name))?> extends <?=EloquentModelsGeneration::EXTENDS . PHP_EOL?>
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '<?=$name?>';
    <?php
        $columns->each(function (ColumnSchemaModel $column) use ($tab) {
            echo "public {$column->dataType} \${$column->columnName};" . PHP_EOL . $tab;
        });
    ?>

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [<?php
        $j = 0;
        $columns->each(function (ColumnSchemaModel $column, int $i) use (&$j) {
            if ($column->columnKey === 'PRI') return;
            if ($j !== 0) echo ', ';
            $j = 1;
            echo "'{$column->columnName}'";
        });
        echo "];" . PHP_EOL;
    ?>
}
