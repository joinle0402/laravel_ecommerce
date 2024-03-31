<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface WardRepository extends BaseRepository
{
    function findByDistrictCode(string $districtCode): Collection;
}
