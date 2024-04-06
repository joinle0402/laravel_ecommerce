<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class BaseRepositoryImplementation implements BaseRepository
{
    public function __construct(protected Model $model) {}

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): Model|Collection|Builder|array|null
    {
        return $this->model->query()->findOrFail($id);
    }

    public function deleteById(int $id): mixed
    {
        return $this->model->query()->where('id', $id)->delete();
    }

    public function deleteByIds(array $ids): mixed
    {
        return $this->model->query()->whereIn('id', $ids)->delete();
    }

    public function create(array $attribute): Builder|Model
    {
        return $this->model->newQuery()->create($attribute);
    }
}
