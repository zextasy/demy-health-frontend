<?php

use App\Http\Controllers\Backend\Admin\RoleController;
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

Route::middleware(['admin'])->prefix('backend/admin')->name('backend.admin.')->group(function () {
    Route::resource('role', RoleController::class, [
        'names' => [
            'index' => 'role.index',
            'create' => 'role.create',
            'store' => 'role.store',
            'show' => 'role.show',
            'edit' => 'role.edit',
            'update' => 'role.update',
            'destroy' => 'role.destroy',
        ],
    ]);
});
