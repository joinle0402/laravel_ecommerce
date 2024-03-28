<?php
namespace App\Services\Implementations;

use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\UserService;
use Illuminate\Database\Eloquent\Collection;

class UserServiceImplementation implements UserService
{
    public function __construct(protected UserRepository $userRepository) {}

    function all(): Collection
    {
        return $this->userRepository->all();
    }
}
