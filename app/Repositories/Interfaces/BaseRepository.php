<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

interface BaseRepository
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function all(): Collection;
    public function findById(int $id): Model|Collection|Builder|array|null;
    public function create(array $attribute);
    public function deleteById(int $id): mixed;
    public function deleteByIds(array $ids): mixed;
}
