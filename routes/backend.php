<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Backend routes for your application. These
| routes are used for the backend.
|
*/

Route::middleware(['backend'])->prefix('backend')->name('backend.')->group(function () {
    //
});
