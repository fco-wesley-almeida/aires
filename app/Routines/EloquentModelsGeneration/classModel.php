<?php

use App\Routines\EloquentModelsGeneration\ColumnSchemaModel;
use App\Routines\EloquentModelsGeneration\EloquentModelsGeneration;
use App\Routines\EloquentModelsGeneration\RelationSchemaModel;
use App\Routines\EloquentModelsGeneration\StringUtils;

if (isset($columns)) {
    $columns = collect($columns);
}

if (isset($relations)) {
    $relations = collect($relations);
}

$tab = "    ";

echo '<?php' . PHP_EOL;
?>

namespace <?= EloquentModelsGeneration::NAMESPACE?>;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/*
<?php
    $columns->each(function (ColumnSchemaModel $column) {
       echo " * @property {$column->dataType} \${$column->columnName}" . PHP_EOL;
    });
    $relations->each(function (RelationSchemaModel $relation) {
        $camelCaseTableName = StringUtils::snakeCaseToCamelCase($relation->sonTable);
        $prop = $relation->isUnique ? lcfirst($camelCaseTableName) : lcfirst(StringUtils::pluralizeWord($camelCaseTableName));
        $type = ucfirst($camelCaseTableName) . ($relation->isUnique ? "" : "[]");
        echo " * @property $type \${$prop}" . PHP_EOL;
    });
?>
*/
class <?= ucfirst(StringUtils::snakeCaseToCamelCase($name))?> extends <?=EloquentModelsGeneration::EXTENDS . PHP_EOL?>
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '<?=$name?>';

    public array $tree = [<?php
        if ($relations->count() === 0)
        {
            echo "];";
        } else {
            echo PHP_EOL;
            $relationNumber = $relations->count();
            $i = 0;
            $relations->each(function (RelationSchemaModel $relation) use (&$i, $relationNumber, $tab)
            {
                $className = StringUtils::snakeCaseToCamelCase($relation->sonTable);
                $classNamePascalCase = ucfirst($className);
                $className = lcfirst($className);
                if (!$relation->isUnique) {
                    $className = StringUtils::pluralizeWord($className);
                }
                echo "$tab$tab'$className' => [$classNamePascalCase::class]";
                if ($i !== $relationNumber -1){
                    echo ',';
                }
                echo PHP_EOL;
            });
            echo "$tab];" . PHP_EOL;
        }
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
    <?php
    echo PHP_EOL;
    $relations->each(function (RelationSchemaModel $relation){
        $className = StringUtils::snakeCaseToCamelCase($relation->sonTable);
        $classNamePascalCase = ucfirst($className);
        if (!$relation->isUnique) {
            $classNamePluralized = StringUtils::pluralizeWord($className);
            $methodDefinition = /** @lang text */
                <<<PHP
                public function get$classNamePluralized(): HasMany
                {
                    return \$this->hasMany($classNamePascalCase::class);
                }
            PHP;
        } else {
            $methodDefinition = /** @lang text */
                <<<PHP
                public function get$classNamePascalCase(): HasOne
                {
                    return \$this->hasOne($classNamePascalCase::class);
                }
            PHP;
        }
        echo $methodDefinition . PHP_EOL . PHP_EOL;
    })
    ?>
}
