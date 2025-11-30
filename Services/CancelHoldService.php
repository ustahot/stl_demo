<?php

namespace App\Services;

use App\Exceptions\HoldException;
use App\Models\Hold;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isCallable;

class CancelHoldService
{

    public function __construct(readonly private Hold $hold)
    {
    }

    /**
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
            $this->hold->refresh();

            if (!$this->hold->status->isConfirmed()) {
                DB::rollBack();
                HoldException::throwConflict();
            }

            $this->hold->slot->remaining++;
            $this->hold->slot->save();
            $this->hold->setCanceledStatus();
            $this->hold->save();

            DB::commit();

            return $this->hold;
        } catch (HoldException $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
