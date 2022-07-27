<?php

use App\Http\Controllers\Backend\AddressController;
use App\Http\Controllers\Backend\LocalGovernmentAreaController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SocialMediaLinkController;
use App\Http\Controllers\Backend\SpecimenTypeController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TeamMemberController;
use App\Http\Controllers\Backend\TestBookingController;
use App\Http\Controllers\Backend\TestCategoryController;
use App\Http\Controllers\Backend\TestCenterController;
use App\Http\Controllers\Backend\TestTypeController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\BackendController;
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

Route::middleware(['backend', 'auth'])->prefix('backend')->name('backend.')->group(function () {
    Route::get('/info', [BackendController::class, 'info'])
        ->name('info');

    Route::resource('address', AddressController::class, [
        'names' => [
            'index' => 'address.index',
            'create' => 'address.create',
            'store' => 'address.store',
            'show' => 'address.show',
            'edit' => 'address.edit',
            'update' => 'address.update',
            'destroy' => 'address.destroy',
        ],
    ]);

    Route::resource('local-government-area', LocalGovernmentAreaController::class, [
        'names' => [
            'index' => 'local-government-area.index',
            'create' => 'local-government-area.create',
            'store' => 'local-government-area.store',
            'show' => 'local-government-area.show',
            'edit' => 'local-government-area.edit',
            'update' => 'local-government-area.update',
            'destroy' => 'local-government-area.destroy',
        ],
    ]);

    Route::resource('product-category', ProductCategoryController::class, [
        'names' => [
            'index' => 'product-category.index',
            'create' => 'product-category.create',
            'store' => 'product-category.store',
            'show' => 'product-category.show',
            'edit' => 'product-category.edit',
            'update' => 'product-category.update',
            'destroy' => 'product-category.destroy',
        ],
    ]);

    Route::resource('product', ProductController::class, [
        'names' => [
            'index' => 'product.index',
            'create' => 'product.create',
            'store' => 'product.store',
            'show' => 'product.show',
            'edit' => 'product.edit',
            'update' => 'product.update',
            'destroy' => 'product.destroy',
        ],
    ]);

    Route::resource('social-media-link', SocialMediaLinkController::class, [
        'names' => [
            'index' => 'social-media-link.index',
            'create' => 'social-media-link.create',
            'store' => 'social-media-link.store',
            'show' => 'social-media-link.show',
            'edit' => 'social-media-link.edit',
            'update' => 'social-media-link.update',
            'destroy' => 'social-media-link.destroy',
        ],
    ]);

    Route::resource('specimen-type', SpecimenTypeController::class, [
        'names' => [
            'index' => 'specimen-type.index',
            'create' => 'specimen-type.create',
            'store' => 'specimen-type.store',
            'show' => 'specimen-type.show',
            'edit' => 'specimen-type.edit',
            'update' => 'specimen-type.update',
            'destroy' => 'specimen-type.destroy',
        ],
    ]);

    Route::resource('state', StateController::class, [
        'names' => [
            'index' => 'state.index',
            'create' => 'state.create',
            'store' => 'state.store',
            'show' => 'state.show',
            'edit' => 'state.edit',
            'update' => 'state.update',
            'destroy' => 'state.destroy',
        ],
    ]);

    Route::resource('team-member', TeamMemberController::class, [
        'names' => [
            'index' => 'team-member.index',
            'create' => 'team-member.create',
            'store' => 'team-member.store',
            'show' => 'team-member.show',
            'edit' => 'team-member.edit',
            'update' => 'team-member.update',
            'destroy' => 'team-member.destroy',
        ],
    ]);

    Route::resource('test-booking', TestBookingController::class, [
        'names' => [
            'index' => 'test-booking.index',
            'create' => 'test-booking.create',
            'store' => 'test-booking.store',
            'show' => 'test-booking.show',
            'edit' => 'test-booking.edit',
            'update' => 'test-booking.update',
            'destroy' => 'test-booking.destroy',
        ],
    ]);

    Route::resource('test-category', TestCategoryController::class, [
        'names' => [
            'index' => 'test-category.index',
            'create' => 'test-category.create',
            'store' => 'test-category.store',
            'show' => 'test-category.show',
            'edit' => 'test-category.edit',
            'update' => 'test-category.update',
            'destroy' => 'test-category.destroy',
        ],
    ]);

    Route::resource('test-center', TestCenterController::class, [
        'names' => [
            'index' => 'test-center.index',
            'create' => 'test-center.create',
            'store' => 'test-center.store',
            'show' => 'test-center.show',
            'edit' => 'test-center.edit',
            'update' => 'test-center.update',
            'destroy' => 'test-center.destroy',
        ],
    ]);

    Route::resource('test-type', TestTypeController::class, [
        'names' => [
            'index' => 'test-type.index',
            'create' => 'test-type.create',
            'store' => 'test-type.store',
            'show' => 'test-type.show',
            'edit' => 'test-type.edit',
            'update' => 'test-type.update',
            'destroy' => 'test-type.destroy',
        ],
    ]);

    Route::resource('user', UserController::class, [
        'names' => [
            'index' => 'user.index',
            'create' => 'user.create',
            'store' => 'user.store',
            'show' => 'user.show',
            'edit' => 'user.edit',
            'update' => 'user.update',
            'destroy' => 'user.destroy',
        ],
    ]);
});
