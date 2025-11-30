<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int id
 * @property string code
 */
class HoldStatus extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * @return bool
     */
    public function isConflict(): bool
    {
        return $this->code === self::getConflictInstance()->code;
    }


    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->code === self::getConfirmedInstance()->code;
    }


    /**
     * @return bool
     */
    public function isHeld(): bool
    {
        return $this->code === self::getHeldInstance()->code;
    }


    /**
     * @return self
     */
    public static function getConflictInstance(): self
    {
        return self::where('code', 'conflict')->first();
    }

    /**
     * @return self
     */
    public static function getConfirmedInstance(): self
    {
        return self::where('code', 'confirmed')->first();
    }

    /**
     * @return self
     */
    public static function getCanceledInstance(): self
    {
        return self::where('code', 'canceled')->first();
    }

    /**
     * @return self
     */
    public static function getHeldInstance(): self
    {
        return self::where('code', 'held')->first();
    }

}
