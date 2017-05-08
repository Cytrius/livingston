<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Represents a database Model
 */
class Provinces extends Model
{

    /**
     * The table used by this model
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * Protected from mass assignment
     *
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

}