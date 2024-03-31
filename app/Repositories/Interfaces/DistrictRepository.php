<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface DistrictRepository extends BaseRepository
{
    function findByProvinceCode(string $provinceCode): Collection;
}
