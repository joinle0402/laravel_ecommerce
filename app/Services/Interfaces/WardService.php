<?php
namespace App\Services\Interfaces;

interface WardService
{
    function findByDistrictCode(string $districtCode);
}
