<?php

use Nurdaulet\FluxBase\Http\Controllers\BannerController;
use Nurdaulet\FluxBase\Http\Controllers\CityController;
use Nurdaulet\FluxBase\Http\Controllers\ComplaintReasonController;
use Nurdaulet\FluxBase\Http\Controllers\RatingController;
use Nurdaulet\FluxBase\Http\Controllers\MobileAppController;
use Nurdaulet\FluxBase\Http\Controllers\TempImageController;
use Nurdaulet\FluxBase\Http\Controllers\TypeOrganizationController;
use Nurdaulet\FluxBase\Http\Controllers\InfoBalanceController;
use Nurdaulet\FluxBase\Http\Controllers\SupportController;
use Nurdaulet\FluxBase\Http\Controllers\ClickHistoryController;
use Nurdaulet\FluxBase\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;


Route::prefix('api')->group(function () {
    Route::get('cities', CityController::class);
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

});
