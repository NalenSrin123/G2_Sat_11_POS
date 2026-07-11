<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Restaurant table routes are registered centrally in routes/api.php.
});
