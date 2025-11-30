<?php

namespace App\Observers;

use App\Models\Slot;
use App\Services\InvalidCacheService;

class SlotObserver
{
    /**
     * Handle the Slot "created" event.
     */
    public function created(Slot $slot): void
    {
        //
    }

    /**
     * Handle the Slot "updated" event.
     */
    public function updated(Slot $slot): void
    {
        (new InvalidCacheService())->do();
    }

    /**
     * Handle the Slot "deleted" event.
     */
    public function deleted(Slot $slot): void
    {
        //
    }

    /**
     * Handle the Slot "restored" event.
     */
    public function restored(Slot $slot): void
    {
        //
    }

    /**
     * Handle the Slot "force deleted" event.
     */
    public function forceDeleted(Slot $slot): void
    {
        //
    }
}
