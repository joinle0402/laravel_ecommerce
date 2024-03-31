<?php
namespace App\Services\Implementations;

use App\Repositories\Interfaces\DistrictRepository;
use App\Services\Interfaces\DistrictService;
use Illuminate\Database\Eloquent\Collection;

class DistrictServiceImplementation implements DistrictService
{
    public function __construct(protected DistrictRepository $districtRepository) {}

    function findByProvinceCode(string $provinceCode): Collection
    {
        return $this->districtRepository->findByProvinceCode($provinceCode);
    }
}
