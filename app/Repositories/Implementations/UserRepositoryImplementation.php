<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Override;

class UserRepositoryImplementation extends BaseRepositoryImplementation implements UserRepository
{
    public function __construct(User $model) { parent::__construct($model); }

    #[Override]
    public function paginate(int $perPage = 10, array $conditions = []): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('province', 'district', 'ward')
            ->when($conditions['keyword'] ?? '', function (Builder $query, string $keyword) {
                $query->where("name", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("phone", "LIKE", "%$keyword%");
            })
            ->paginate($perPage);
    }
}
