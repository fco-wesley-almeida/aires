<?php


namespace App\Src\Domain\EloquentModels;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EloquentModel extends Model
{
    public array $tree = [];

    /**
     * @throws Exception
     * @var mixed
     */

    public function createTree(): bool
    {
        DB::beginTransaction();
        if (!$this->save())
        {
            throw new Exception("Failure on save model" . get_class($this));
        }
        foreach ($this->tree as $key => $node)
        {
            if ($this->$key == null)
            {
               continue;
            }
            switch (gettype($node))
            {
                case 'array':
                    $nodes = collect($this->$key);
                    $nodes->each(function ($model) use ($node)
                    {
                        if (get_class($model) !== $node[0])
                        {
                           throw new Exception("Expected type is {$node[0]}. Found was " . get_class($model) . ".");
                        }
                        $key = $this->table . "_id";
                        $id = 'id';
                        $model->$key = $this->$id;
                        if (!$model->save())
                        {
                           throw new Exception("Failure on save model" . $node);
                        }
                    });
                    break;
                case 'string':
                    $model = $this->$key;
                    if ($model === null) break;
                    if (get_class($model) !== $node)
                    {
                        throw new Exception("Expected type is $node. Found was " . get_class($model) . ".");
                    }
                    $key = $this->table . "_id";
                    $id = 'id';
                    $model->$key = $this->$id;
                    if (!$model->save())
                    {
                        throw new Exception("Failure on save model" . $node);
                    }
                    break;
                default:
                    throw new Exception("Type wrong on " . self::class);
            }
        }
        DB::commit();
        return true;
    }

}
