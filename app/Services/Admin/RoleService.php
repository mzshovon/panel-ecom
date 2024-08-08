<?php

namespace App\Services\Admin;

use App\Contracts\Admin\RoleServiceInterface;
use App\Repo\RoleRepo;
use Illuminate\Database\Eloquent\Model;

class RoleService implements RoleServiceInterface
{
    function __construct(
        private readonly RoleRepo $RoleRepo
    ){}

    /**
     * @return array
     */
    function getRoles() : array
    {
        $data = $this->RoleRepo->get();
        return $data ?? [];
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    function getRoleById(int $id) : Model|null
    {
        $data = $this->RoleRepo->getByColumn("id",$id);
        return $data;
    }

    /**
     * @param array $request
     *
     * @return bool
     */
    function createRole(array $request) : bool
    {
        if(isset($request['password'])) {
            $request['password'] = bcrypt($request['password']);
        }
        $data = $this->RoleRepo->create($request);
        return $data ? true : false;
    }

    /**
     * @param int $id
     * @param array $request
     *
     * @return bool
     */
    function updateRole(int $id, array $request) : bool
    {
        if(isset($request['password']) && $request['password']) {
            $request['password'] = bcrypt($request['password']);
        } else {
            unset($request['password']);
        }
        if(isset($request['role'])) {
            $Role = $this->RoleRepo->findOrFail($id);
            $Role->syncRoles([$request['role']]);
        }
        $data = $this->RoleRepo->update("id", $id, $this->fillableData($request));
        return $data ?? false;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    function deleteRole(int $id) : bool
    {
        $data = $this->RoleRepo->delete("id", $id);
        return $data ?? false;
    }

    /**
     * @param array $request
     *
     * @return array
     */
    private function fillableData(array $request) : array
    {
        $data = [];
        $fillable = [
            'name',
            'display_name',
            'description',
        ];
        foreach ($request as $key => $value) {
            if(in_array($key, $fillable)){
                $data[$key] = $value;
            }
        }
        return $data;
    }
}
