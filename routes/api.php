<?php

declare(strict_types=1);

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function (): void {
    Route::apiResource('events', EventController::class);
    Route::post('events/{event}/register', [RegistrationController::class, 'store'])->name('events.register');
    Route::delete('events/{event}/register', [RegistrationController::class, 'destroy'])->name('events.unregister');
});
