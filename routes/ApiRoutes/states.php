<?php

use App\Http\Controllers\Api\v1\StateController;
use Illuminate\Support\Facades\Route;

Route::controller(StateController::class)->group(function(){
    Route::get('/{state}/check-capacity', 'checkCapacity')->name('checkCapacity');
})->name('states.');