<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\AddressController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TestTypeController;
use App\Http\Controllers\Backend\TeamMemberController;
use App\Http\Controllers\Backend\TestCenterController;
use App\Http\Controllers\Backend\Admin\RoleController;
use App\Http\Controllers\Backend\TestBookingController;
use App\Http\Controllers\Backend\SpecimenTypeController;
use App\Http\Controllers\Backend\TestCategoryController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\SocialMediaLinkController;
use App\Http\Controllers\Backend\LocalGovernmentAreaController;

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
        ]
    ]);
});
