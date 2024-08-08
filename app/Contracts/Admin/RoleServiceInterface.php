<?php

namespace App\Contracts\Admin;

use Illuminate\Database\Eloquent\Model;

interface RoleServiceInterface {

    function getRoles():array;
    function getRoleById(int $id) : Model|null;
    function createRole(array $request) : bool;
    function updateRole(int $id, array $request) : bool;
    function deleteRole(int $id) : bool;

}
