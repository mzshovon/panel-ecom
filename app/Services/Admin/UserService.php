<?php

namespace App\Services\Admin;

use App\Contracts\Admin\UserServiceInterface;
use App\Repo\UserRepo;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{
    protected string $imagePath = "storage/img/user/{id}/";

    function __construct(
        private readonly UserRepo $userRepo
    ){}

    /**
     * @return array
     */
    function getUsers() : array
    {
        $data = $this->userRepo->get();
        return $data ?? [];
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    function getUserById(int $id) : Model|null
    {
        $data = $this->userRepo->getByColumn("id",$id);
        return $data;
    }

    /**
     * @param array $request
     *
     * @return bool
     */
    function createUser(array $request) : bool
    {
        if(isset($request['password'])) {
            $request['password'] = bcrypt($request['password']);
        }
        $data = $this->userRepo->create($request);
        return $data ? true : false;
    }

    /**
     * @param int $id
     * @param array $request
     *
     * @return bool
     */
    function updateUser(int $id, array $request) : bool
    {
        if(isset($request['password']) && $request['password']) {
            $request['password'] = bcrypt($request['password']);
        } else {
            unset($request['password']);
        }
        if(isset($request['role'])) {
            $user = $this->userRepo->findOrFail($id);
            $user->syncRoles([$request['role']]);
        }
        if(isset($request['profile_image'])) {
            $request['image'] = $this->uploadImageandGetImageDir($request['profile_image'], $id);
        }
        $data = $this->userRepo->update("id", $id, $this->fillableData($request));
        return $data ?? false;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    function deleteUser(int $id) : bool
    {
        $data = $this->userRepo->delete("id", $id);
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
            'email',
            'password',
            'address',
            'status',
            'mobile',
            'image',
        ];
        foreach ($request as $key => $value) {
            if(in_array($key, $fillable)){
                $data[$key] = $value;
            }
        }
        return $data;
    }

    /**
     * @param array $image
     * @param int $userId
     *
     * @return array
     */
    private function uploadImageandGetImageDir($image, int $userId) : string
    {
        $imgPath = str_replace("{id}", $userId, $this->imagePath);
        $image_path = storeOrUpdateImage($imgPath, $image, $image->getClientOriginalName());
        return $image_path;
    }
}
