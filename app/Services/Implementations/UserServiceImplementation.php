<?php
namespace App\Services\Implementations;

use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\UserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserServiceImplementation implements UserService
{
    public function __construct(protected UserRepository $userRepository) {}

    function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPage);
    }
}
