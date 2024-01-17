<?php

use Nurdaulet\FluxBase\Http\Controllers\BannerController;
use Nurdaulet\FluxBase\Http\Controllers\CityController;
use Nurdaulet\FluxBase\Http\Controllers\ComplaintReasonController;
use Nurdaulet\FluxBase\Http\Controllers\CountryController;
use Nurdaulet\FluxBase\Http\Controllers\LinkController;
use Nurdaulet\FluxBase\Http\Controllers\PaymentMethodController;
use Nurdaulet\FluxBase\Http\Controllers\RatingController;
use Nurdaulet\FluxBase\Http\Controllers\MobileAppController;
use Nurdaulet\FluxBase\Http\Controllers\RentTypeController;
use Nurdaulet\FluxBase\Http\Controllers\TempImageController;
use Nurdaulet\FluxBase\Http\Controllers\TypeOrganizationController;
use Nurdaulet\FluxBase\Http\Controllers\InfoBalanceController;
use Nurdaulet\FluxBase\Http\Controllers\SupportController;
use Nurdaulet\FluxBase\Http\Controllers\ClickHistoryController;
use Nurdaulet\FluxBase\Http\Controllers\PartnerController;
use Nurdaulet\FluxBase\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Route;
use Nurdaulet\FluxBase\Http\Controllers\WebSiteConfigController;


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
