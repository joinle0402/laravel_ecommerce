<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;

class UserRepositoryImplementation extends BaseRepositoryImplementation implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
