<?php

namespace App\Http\Controllers;

use App\Http\Resources\SlotResource;
use App\Services\AvailabilitySlotService;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function __invoke()
    {
        $result = (new AvailabilitySlotService())->do();

        return SlotResource::collection($result)->resolve();
    }
}
