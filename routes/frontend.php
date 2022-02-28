<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/covid-19-pcr-testing', [FrontendController::class, 'covid19PCRTesting'])
    ->name('covid-19-pcr-testing');

Route::get('/services/all-services', [FrontendController::class, 'allServices'])
    ->name('services.all-services');

Route::get('/services/lab-tests', [FrontendController::class, 'labTests'])
    ->name('services.lab-tests');

Route::get('/services/revolutionary-panel-testing', [FrontendController::class, 'revolutionaryPanelTesting'])
    ->name('services.revolutionary-panel-testing');

Route::get('/services/molecular-diagnosis', [FrontendController::class, 'molecularDiagnosis'])
    ->name('services.molecular-diagnosis');

Route::get('/portfolio', [FrontendController::class, 'portfolio'])
    ->name('portfolio');

Route::get('/about/about-us', [FrontendController::class, 'aboutUs'])
    ->name('about.about-us');

Route::get('/about/our-team', [FrontendController::class, 'ourTeam'])
    ->name('about.our-team');

Route::get('/about/mission-statement', [FrontendController::class, 'missionStatement'])
    ->name('about.mission-statement');

Route::get('/contact', [FrontendController::class, 'contactUs'])
    ->name('contact');
