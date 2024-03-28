<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface UserService
{
    function all(): Collection;
}
