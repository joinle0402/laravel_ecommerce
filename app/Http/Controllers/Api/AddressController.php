<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\DistrictService;
use App\Services\Interfaces\WardService;
use Illuminate\Database\Eloquent\Collection;

class AddressController extends Controller
{
    public function __construct(
        protected DistrictService $districtService,
        protected WardService $wardService
    ) {}

    function findDistrictsByProvinceCode(string $provinceCode): Collection
    {
        return $this->districtService->findByProvinceCode($provinceCode);
    }

    function findWardsByProvinceCode(string $districtCode): Collection
    {
        return $this->wardService->findByDistrictCode($districtCode);
    }
}
