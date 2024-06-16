<?php

namespace App\Contracts\Admin;

use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface {

    function getUsers():array;
    function getUserById(int $id) : Model|null;
    function createUser(array $request) : bool;
    function updateUser(int $id, array $request) : bool;
    function deleteUser(int $id) : bool;

}
