<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Represents a database Model
 */
class Settings extends Model
{

    /**
     * The table used by this model
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * Protected from mass assignment
     *
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

}
