<?php

use Nurdaulet\FluxBase\Http\Controllers\Api\BannerController;
use Nurdaulet\FluxBase\Http\Controllers\Api\CityController;
use Nurdaulet\FluxBase\Http\Controllers\Api\ComplaintReasonController;
use Nurdaulet\FluxBase\Http\Controllers\Api\CountryController;
use Nurdaulet\FluxBase\Http\Controllers\Api\LinkController;
use Nurdaulet\FluxBase\Http\Controllers\Api\PaymentMethodController;
use Nurdaulet\FluxBase\Http\Controllers\Api\RatingController;
use Nurdaulet\FluxBase\Http\Controllers\Api\MobileAppController;
use Nurdaulet\FluxBase\Http\Controllers\Api\RentTypeController;
use Nurdaulet\FluxBase\Http\Controllers\Api\TempImageController;
use Nurdaulet\FluxBase\Http\Controllers\Api\TypeOrganizationController;
use Nurdaulet\FluxBase\Http\Controllers\Api\InfoBalanceController;
use Nurdaulet\FluxBase\Http\Controllers\Api\SupportController;
use Nurdaulet\FluxBase\Http\Controllers\Api\ClickHistoryController;
use Nurdaulet\FluxBase\Http\Controllers\Api\PartnerController;
use Nurdaulet\FluxBase\Http\Controllers\Api\LayoutController;
use Illuminate\Support\Facades\Route;
use Nurdaulet\FluxBase\Http\Controllers\Api\WebSiteConfigController;
use Nurdaulet\FluxBase\Http\Controllers\Web\FileUploadController;


Route::prefix('api')->group(function () {
    Route::group(['prefix' => 'methods'], function () {
        Route::get('payment', PaymentMethodController::class);
    });

    Route::get('cities', [CityController::class,'index']);
    Route::get('links', LinkController::class);
    Route::get('countries', [CountryController::class,'index']);
    Route::get('countries/{id}/cities', [CountryController::class,'cities']);
    Route::get('rent-types', RentTypeController::class);
    Route::get('layout', LayoutController::class);
    Route::get('banners', BannerController::class);
    Route::get('ratings', RatingController::class);
    Route::get('type-organizations', TypeOrganizationController::class);
    Route::get('complain-reasons',  ComplaintReasonController::class);
    Route::get('mobile-app/version', [MobileAppController::class, 'currentVersion']);
    Route::post('temp-images', [TempImageController::class, 'upload'])->middleware('auth:sanctum');
    Route::get('info-balance', InfoBalanceController::class);
    Route::post('support', [SupportController::class, 'store']);
    Route::get('partners', [PartnerController::class, 'index']);
    Route::post('click', [ClickHistoryController::class, 'store']);


    Route::get('web-site-config', [WebSiteConfigController::class,'index']);
    Route::post('web-site-config', [WebSiteConfigController::class,'store']);

});
Route::post('/livewire/upload-file', [FileUploadController::class, 'handle'])
    ->name('livewire.upload-file')
    ->middleware('web');