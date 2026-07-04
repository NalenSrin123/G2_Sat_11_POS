<?php

use Illuminate\Support\Facades\Route;
use Modules\Restaurant\Http\Controllers\RestaurantTableController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('restaurant-tables', RestaurantTableController::class)->names('restaurant-table');
});
