<?php
namespace App\Services\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserService
{
    function paginate(int $perPage, array $conditions): LengthAwarePaginator;
    function create(array $attribute);
    function deleteById(int $id): mixed;
    function deleteByIds(array $ids = []): mixed;
}
