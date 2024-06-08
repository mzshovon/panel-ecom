<?php

namespace App\Contracts\Admin;

use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface {

    function getUsers():array;
    function getUserById():Model;
    function createUser():bool;
    function updateUser():bool;
    function deleteUser():bool;

}
