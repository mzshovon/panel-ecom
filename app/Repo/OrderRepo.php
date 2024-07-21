<?php

namespace App\Repo;

use App\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\Model;

final readonly class OrderRepo
{
    private Model $model;

    /**
     * @param  private
     */
    function __construct(private Order $order)
    {
        $this->model = $order;
    }

    /**
     * @return array
     */
    function get($columns = ["*"]) : array
    {
        try {
            $data = $this->model::orderBy("updated_at", "desc")
                ->get($columns)
                ->toArray();
            return !empty($data) ? $data : [];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param string $column
     * @param string $value
     *
     * @return Model|null
     */
    function getByColumn(string $column = "id", string $value) : Model|null
    {
        try {
            $data = $this->model::where($column, $value)->first();
            return $data ?? null;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param array $request
     *
     * @return Model
     */
    function create(array $request) : Model
    {
        try {
            return $this->model::create($request);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param string $column
     * @param mixed $value
     * @param array $request
     *
     * @return bool
     */
    function update(string $column = "id", $value, array $request) : bool
    {
        try {
            return $this->model::where($column, $value)->update($request);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param string $column
     * @param mixed $value
     *
     * @return bool
     */
    function delete(string $column = "id", $value) : bool
    {
        try {
            return $this->model::where($column, $value)->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
