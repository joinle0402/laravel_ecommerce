<?php

namespace App\Repositories\Implementations;

use App\Models\Ward;
use App\Repositories\Interfaces\WardRepository;
use Illuminate\Database\Eloquent\Collection;

class WardRepositoryImplementation extends BaseRepositoryImplementation implements WardRepository
{
    public function __construct(Ward $modelInstance)
    {
        parent::__construct($modelInstance);
    }

    function findByDistrictCode(string $districtCode): Collection
    {
        return $this->model->query()->where('district_code', $districtCode)->get();
    }
}
