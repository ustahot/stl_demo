<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int id
 * @property int capacity
 * @property int remaining
 */
class Slot extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public static function cacheKey()
    {
        return 'availability_slots';
    }

    public static function getTtl()
    {
        return 10;
    }
}
