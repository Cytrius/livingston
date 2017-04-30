<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Represents a database Model
 */
class Rates extends Model
{
    use SoftDeletes;

    /**
     * The table used by this model
     *
     * @var string
     */
    protected $table = 'rates';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Protected from mass assignment
     *
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

}