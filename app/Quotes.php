<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Account;
use App\User;
/**
 * Represents a database Model
 */
class Quotes extends Model
{
    use SoftDeletes;

    /**
     * The table used by this model
     *
     * @var string
     */
    protected $table = 'quotes';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'departure_at'];

    /**
     * Protected from mass assignment
     *
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function account() {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}