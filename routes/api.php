<?php

use App\Http\Controllers\HoldController;
use App\Http\Controllers\SlotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

 Route::get('/slots/availability', \App\Http\Controllers\AvailabilityController::class);
 Route::post('/slots/{slot}/hold', [HoldController::class, 'store']);
 Route::post('/holds/{hold}/confirm', [HoldController::class, 'confirm']);
 Route::delete('/holds/{hold}', [HoldController::class, 'cancel']);

