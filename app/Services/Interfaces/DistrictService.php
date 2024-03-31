<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface DistrictService
{
    function findByProvinceCode(string $provinceCode): Collection;
}
