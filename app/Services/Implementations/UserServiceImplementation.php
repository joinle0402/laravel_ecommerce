<?php
namespace App\Services\Implementations;

use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\UserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserServiceImplementation implements UserService
{
    public function __construct(protected UserRepository $userRepository) {}

    function paginate(int $perPage, array $conditions = []): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPage, $conditions);
    }

    function deleteById(int $id): mixed
    {
        return $this->userRepository->deleteById($id);
    }

    function deleteByIds(array $ids = []): mixed
    {
        return $this->userRepository->deleteByIds($ids);
    }
}
