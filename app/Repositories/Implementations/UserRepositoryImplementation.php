<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepositoryImplementation extends BaseRepositoryImplementation implements UserRepository
{
    public function __construct(User $model) { parent::__construct($model); }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->query()->with('province', 'district', 'ward')->paginate($perPage);
    }
}
