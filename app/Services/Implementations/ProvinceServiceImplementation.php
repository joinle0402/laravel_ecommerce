<?php
namespace App\Services\Implementations;

use App\Repositories\Interfaces\ProvinceRepository;
use App\Services\Interfaces\ProvinceService;
use Illuminate\Database\Eloquent\Collection;

class ProvinceServiceImplementation implements ProvinceService
{
    public function __construct(protected ProvinceRepository $provinceRepository) {}

    function all(): Collection
    {
        return $this->provinceRepository->all();
    }
}
