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
    function get($columns = ["*"], $take = null) : array
    {
        try {
            $data = $this->model::with("products", "orderedBy")
                ->orderBy("updated_at", "desc")
                ->when($take, function($q) use ($take){
                    $q->take($take);
                })
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
            $data = $this->model::with("products")->where($column, $value)->first();
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
            $order = $this->model::where($column, $value)->firstOrFail();
            // Update the order attributes
            $order->fill($request);
            // Save the order to trigger the updating event
            $order->update();
            return $order ? true : false;

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
            $order = $this->model::where($column, $value)->firstOrFail();
            return $order->delete() ? true : false;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
