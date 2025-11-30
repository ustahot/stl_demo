<?php

namespace App\Services;

use App\Models\Slot;
use Illuminate\Support\Facades\Cache;

class InvalidCacheService
{
    public function do()
    {
        Cache::forget(Slot::cacheKey());
    }
}
