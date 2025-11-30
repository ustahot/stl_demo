<?php

namespace App\Services;

use App\Exceptions\HoldException;
use App\Models\Hold;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;

class ConfirmHoldService
{

    public function __construct(readonly private Hold $hold)
    {
    }


    /**
     * @return Hold
     * @throws HoldException
     */
    public function do(): Hold
    {

        $slotTable = app(Slot::class)->getTable();
        $holdTable = app(Hold::class)->getTable();

        DB::beginTransaction();

        try {

            DB::table($slotTable)->where('id', $this->hold->slot->id)->sharedLock()->get();
            DB::table($holdTable)->where('id', $this->hold->id)->sharedLock()->get();

            $this->hold->slot->refresh();

            if ($this->hold->slot->remaining < 1) {
                DB::rollBack();
                HoldException::throwConflict();
            }

            $this->hold->refresh();

            if (!$this->hold->status->isHeld()) {
                DB::rollBack();
                HoldException::throwConflict();
            }

            if ($this->hold->expired_at < now()) {
                DB::rollBack();
                HoldException::throwConflict();
            }

            $this->hold->slot->remaining --;
            $this->hold->slot->save();
            $this->hold->setConfirmedStatus();
            $this->hold->save();

            DB::commit();

            $this->hold->refresh();

            return $this->hold;

        } catch (HoldException $exception) {

            DB::rollBack();
            throw $exception;

        }

    }

}
