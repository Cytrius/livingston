<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Represents a database Model
 */
class Profile extends Model
{
    /**
     * The table used by this model
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * Protected from mass assignment
     *
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the additional fields (from json)
     *
     * @param  string  $value
     * @return json
     */
    public function getRedFlagsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Set the additional fields (to json)
     *
     * @param  string  $value
     * @return json
     */
    public function setRedFlagsAttribute($value)
    {
        $newValue = [];
        foreach($value as $key=>$val)
            if (!is_null($val) && !empty($val))
                $newValue[] = $val;

        $this->attributes['red_flags'] = json_encode($newValue);
    }

    /**
     * Get the additional fields (from json)
     *
     * @param  string  $value
     * @return json
     */
    public function getKeywordsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Set the additional fields (to json)
     *
     * @param  string  $value
     * @return json
     */
    public function setKeywordsAttribute($value)
    {
        $this->attributes['keywords'] = json_encode($value);
    }

    /**
     * Get the additional fields (from json)
     *
     * @param  string  $value
     * @return json
     */
    public function getSkillsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Set the additional fields (to json)
     *
     * @param  string  $value
     * @return json
     */
    public function setSkillsAttribute($value)
    {
        $this->attributes['skills'] = json_encode($value);
    }
}