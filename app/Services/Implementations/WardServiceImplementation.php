<?php
namespace App\Services\Implementations;

use App\Repositories\Interfaces\WardRepository;
use App\Services\Interfaces\WardService;

class WardServiceImplementation implements WardService
{
    public function __construct(protected WardRepository $wardRepository) {}

    function findByDistrictCode(string $districtCode)
    {
        return $this->wardRepository->findByDistrictCode($districtCode);
    }
}
