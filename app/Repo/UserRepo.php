<?php

namespace App\Repo;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

final readonly class UserRepo
{
    private Model $model;

    function __construct(private User $user)
    {
        $this->model = $user;
    }

    function get() : array
    {
        try {
            $data = $this->model::get(
                ['name', 'email', 'status', 'created_at as joined_at']
                )->toArray();
            return !empty($data) ? $data : [];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    function getByColumn(string $column = "id", string $value) : Model
    {
        try {
            $data = $this->model::where($column, $value)->first();
            return $data ?? null;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
