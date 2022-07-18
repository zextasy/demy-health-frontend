<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ProductController;

Route::name('frontend.')->group(function () {

    Route::get('index.html', [FrontendController::class, 'home'])
        ->name('home');
    Route::get('covid19-pcr-testing.html', [FrontendController::class, 'covid19PCRTesting'])
        ->name('covid-19-pcr-testing');
    Route::get('covid19-rapid-antigen-testing.html', [FrontendController::class, 'covid19RapidAntigenTesting'])
        ->name('covid-19-rapid-antigen-testing');
    Route::get('AboutUs.html', [FrontendController::class, 'aboutUs'])
        ->name('about.about-us');
    Route::get('OurTeam.html', [FrontendController::class, 'ourTeam'])
        ->name('about.our-team');
    Route::get('missionstatement.html', [FrontendController::class, 'missionStatement'])
        ->name('about.mission-statement');
    Route::get('Contact.html', [FrontendController::class, 'contactUs'])
        ->name('contact');
    Route::get('set-up-your-lab.html', [FrontendController::class, 'setUpYourLab'])
        ->name('set-up-your-lab');
    Route::get('take-a-test.html', [FrontendController::class, 'takeATest'])
        ->name('take-a-test');
    Route::get('test-results.html', [FrontendController::class, 'myTestResults'])
        ->name('test-results');
    Route::get('upcoming-test-bookings.html', [FrontendController::class, 'myUpcomingTestBookings'])
        ->name('upcoming-test-bookings');
    Route::get('my-orders.html', [FrontendController::class, 'myOrders'])
        ->name('my-orders');
    //
    Route::get('/test-bookings/personal/{customerIdentifier}', [FrontendController::class, 'listUpcomingTestBookings'])
        ->name('my-test-bookings.list');
    Route::get('/test-results/personal/{customerIdentifier}', [FrontendController::class, 'listTestResults'])
        ->name('my-test-results.list');
    Route::get('/orders/personal/{customerIdentifier}', [FrontendController::class, 'listOrders'])
        ->name('my-orders.list');
    Route::get('/test-bookings/{id}', [FrontendController::class, 'viewTestBooking'])
        ->name('test-bookings.show');
    Route::get('/test-results/{id}', [FrontendController::class, 'viewTestResult'])
        ->name('test-results.show');
    Route::get('/orders/{id}', [FrontendController::class, 'ViewOrder'])
        ->name('orders.show');

    //
    Route::get('/products', [ProductController::class, 'allProducts'])
        ->name('business-units.products.index');
    Route::get('/products/{id}', [ProductController::class, 'ViewProduct'])
        ->name('business-units.products.show');
    Route::get('pcr-and-reagents.html', [ProductController::class, 'pcrAndReagents'])
        ->name('business-units.products.medical-devices.pcr-and-reagents');
    Route::get('hospital-and-laboratory-products.html', [ProductController::class, 'hospitalAndLaboratoryProducts'])
        ->name('business-units.products.medical-devices.hospital-and-laboratory-products');
    Route::get('pharmaceuticals.html', [ProductController::class, 'pharmaceuticals'])
        ->name('business-units.products.medical-devices.pharmaceuticals.html');
    Route::get('procurement-and-supply.html', [ProductController::class, 'procurementAndSupply'])
        ->name('business-units.products.procurement-and-supply');

    //
    Route::get('/services/all-services', [FrontendController::class, 'allServices'])
        ->name('business-units.services.all-services');
    Route::get('pcr-diag-research.html', [FrontendController::class, 'pcrDiagResearch'])
        ->name('business-units.services.pcr-diag-research');
    Route::get('biomedical-engineering.html', [FrontendController::class, 'biomedicalEngineering'])
        ->name('business-units.services.biomedical-engineering');
    Route::get('sequencing-and-biorepository-services.html', [FrontendController::class, 'sequencingAndBiorepositoryServices'])
        ->name('business-units.services.sequencing-and-biorepository-services');
    Route::get('molecular-biology-training.html', [FrontendController::class, 'molecularBiologyTraining'])
        ->name('business-units.services.molecular-biology-training');

    //
    Route::get('cart-display.html', [CartController::class, 'show'])
        ->name('cart.display');
    Route::get('cart-checkout.html', [CartController::class, 'checkOut'])
        ->name('cart.checkout');
    Route::get('cart-clear.html', [CartController::class, 'clear'])
        ->name('cart.clear');
});
