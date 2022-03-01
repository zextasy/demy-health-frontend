<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('covid19-pcr-testing.html', [FrontendController::class, 'covid19PCRTesting'])
    ->name('covid-19-pcr-testing');
Route::get('/products/all-products', [FrontendController::class, 'allProducts'])
    ->name('business-units.products.all-Products');
Route::get('pcr-and-reagents.html', [FrontendController::class, 'pcrAndReagents'])
    ->name('business-units.products.medical-devices.pcr-and-reagents');
Route::get('hospital-and-laboratory-products.html', [FrontendController::class, 'hospitalAndLaboratoryProducts'])
    ->name('business-units.products.medical-devices.hospital-and-laboratory-products');
Route::get('pharmaceuticals.html', [FrontendController::class, 'pharmaceuticals'])
    ->name('business-units.products.medical-devices.pharmaceuticals.html');
Route::get('procurement-and-supply.html', [FrontendController::class, 'procurementAndSupply'])
    ->name('business-units.products.procurement-and-supply');
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
Route::get('set-up-your-lab.html', [FrontendController::class, 'setUpYourLab'])
    ->name('set-up-your-lab');
Route::get('take-a-test.html', [FrontendController::class, 'TakeATest'])
    ->name('take-a-test');
Route::get('test-results.html', [FrontendController::class, 'TestResults'])
    ->name('test-results');
Route::get('AboutUs.html', [FrontendController::class, 'aboutUs'])
    ->name('about.about-us');
Route::get('OurTeam.html', [FrontendController::class, 'ourTeam'])
    ->name('about.our-team');
Route::get('missionstatement.html', [FrontendController::class, 'missionStatement'])
    ->name('about.mission-statement');
Route::get('Contact.html', [FrontendController::class, 'contactUs'])
    ->name('contact');
