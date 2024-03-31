<?php

use App\Http\Controllers\Api\AddressController;
use Illuminate\Support\Facades\Route;

Route::get('/provinces/{provinceCode}/districts', [AddressController::class, 'findDistrictsByProvinceCode']);
Route::get('/districts/{districtCode}/wards', [AddressController::class, 'findWardsByProvinceCode']);
