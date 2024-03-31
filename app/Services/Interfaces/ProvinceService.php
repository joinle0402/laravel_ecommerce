<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ProvinceService
{
    function all(): Collection;
}
