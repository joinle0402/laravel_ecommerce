<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImplementation extends BaseRepositoryImplementation implements UserRepository
{
    public function __construct(User $model) { parent::__construct($model); }

    public function paginate(int $perPage = 10, array $conditions = []): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('province', 'district', 'ward')
            ->when($conditions['keyword'] ?? '', function (Builder $query, string $keyword) {
                $query->where("name", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("phone", "LIKE", "%$keyword%");
            })
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function create(array $attribute): Model|\Illuminate\Database\Query\Builder
    {
        $attribute['password'] = Hash::make(empty($attribute['password']) ? '1' : $attribute['password']);
        if (!empty($attribute['birthday'])) {
            $attribute['birthday'] = Carbon::createFromFormat('d/m/Y', $attribute['birthday'])->toDateString();
        }
        return $this->model->newQuery()->create($attribute);
    }
}
