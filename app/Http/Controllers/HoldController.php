<?php

namespace App\Http\Controllers;

use App\Exceptions\HoldException;
use App\Http\Requests\Api\Hold\StoreRequest;
use App\Models\Hold;
use App\Models\Slot;
use App\Services\CancelHoldService;
use App\Services\ConfirmHoldService;
use App\Services\HoldSlotService;
use Illuminate\Http\Request;

class HoldController extends Controller
{
    /**
     * @throws HoldException
     */
    public function store(StoreRequest $request, Slot $slot): Hold
    {
        $validated = $request->customValidate();
        return (new HoldSlotService(valistated: $validated, slot: $slot))->do();
    }

    /**
     * @param Hold $hold
     * @return \Illuminate\Http\Response|Hold|\Illuminate\Contracts\Routing\ResponseFactory
     *
     */
    public function confirm(Hold $hold): \Illuminate\Http\Response|Hold|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return (new ConfirmHoldService(hold: $hold))->do();
        } catch (HoldException $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }


    public function cancel(Hold $hold)
    {
        try {
            return (new CancelHoldService(hold: $hold))->do();
        } catch (HoldException $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }
}
