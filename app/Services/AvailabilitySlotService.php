<?php

namespace App\Services;

use App\Models\Slot;
use Illuminate\Support\Facades\Cache;

class AvailabilitySlotService
{

    public function do()
    {

        if (Cache::has(Slot::cacheKey())) {
            return Cache::get(Slot::cacheKey());
        }

        $lock = Cache::lock('slots_block', 10);

        try {
            $lock->block(1);

            if (Cache::has(Slot::cacheKey())) {
                $result = Cache::get(Slot::cacheKey());
            } else {
                $result = Slot::all()->toArray();
                Cache::set(Slot::cacheKey(), $result, Slot::getTtl());
            }

        } catch (\Exception $exception) {
            $result = Slot::all()->toArray();
        } finally {
            $lock->release();

            return $result;
        }
    }

}
