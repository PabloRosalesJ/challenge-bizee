<?php

use App\Http\Controllers\Api\v1\CompanyController;
use Illuminate\Support\Facades\Route;

Route::controller(CompanyController::class)->group(function(){
    Route::post('/', 'store')->name('store');
})->name('company.');