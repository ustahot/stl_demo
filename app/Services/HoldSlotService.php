<?php

namespace App\Services;

use App\Exceptions\HoldException;
use App\Models\Hold;
use App\Models\Slot;

class HoldSlotService
{

    public function __construct(readonly private array $valistated, readonly private Slot $slot)
    {
    }


    /**
     * @return Hold
     * @throws HoldException
     */
    public function do(): Hold
    {

        $hold = Hold::findByIdempotencyKey($this->valistated['idempotency_key']);

        if (isset($hold)) {

            if ($hold->status->isConflict()) {
                HoldException::throwConflict();
            }

            return $hold;
        }

        $hold = new Hold([
            'idempotency_key' => $this->valistated['idempotency_key'],
            'slot_id' => $this->slot->id,
            'expired_at' => now()->addMinutes(5)
        ]);

        if ($this->slot->remaining < 1) {
            $hold->setConflictStatus();
            $hold->save();
            HoldException::throwConflict();
        }

        $hold->setHeldStatus();
        $hold->save();
        $hold->status;

        return $hold;
    }
}
