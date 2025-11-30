<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int id
 * @property HoldStatus status
 * @property int status_id
 * @property Slot slot
 * @property string expired_at
 */
class Hold extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * @param string $idempotencyKey
     * @return Hold|null
     */
    public static function findByIdempotencyKey(string $idempotencyKey): ?Hold
    {
        return self::where('idempotency_key', $idempotencyKey)->first();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(HoldStatus::class);
    }


    /**
     * @return void
     */
    public function setConflictStatus(): void
    {
        $this->status_id = HoldStatus::getConflictInstance()->id;
    }


    /**
     * @return void
     */
    public function setHeldStatus(): void
    {
        $this->status_id = HoldStatus::getHeldInstance()->id;
    }

    /**
     * @return void
     */
    public function setConfirmedStatus(): void
    {
        $this->status_id = HoldStatus::getConfirmedInstance()->id;
    }

    /**
     * @return void
     */
    public function setCanceledStatus(): void
    {
        $this->status_id = HoldStatus::getCanceledInstance()->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slot(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Slot::class);
    }
}
