<?php

namespace App\Services\Admin;

use App\Contracts\Admin\UserServiceInterface;
use App\Repo\UserRepo;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{
    function __construct(
        private readonly UserRepo $userRepo
    ){}

    function getUsers() : array
    {
        $data = $this->userRepo->get();
        return $data ?? [];
    }

    function getUserById() : Model
    {
        return new Model();
    }

    function createUser() : bool
    {
        return true;
    }

    function updateUser() : bool
    {
        return true;
    }

    function deleteUser() : bool
    {
        return false;
    }
}
