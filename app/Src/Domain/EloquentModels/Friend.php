<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/*
 * @property int $id
 * @property int $customer_id
 * @property int $friendship_id
*/
class Friend extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'friend';

    public array $tree = [];
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'friendship_id'];
    
}
