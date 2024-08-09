<?php

namespace App\Repo;

use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final readonly class OrderRepo
{
    private Model $model;

    /**
     * @param  private
     */
    function __construct(
        private Order $order,
        private readonly ProductRepo $productRepo
    )
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
                ->orderBy("invoice_no", "desc")
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
            $this->productRepo->deleteProductCache();
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
            $this->productRepo->deleteProductCache();
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
            $this->productRepo->deleteProductCache();
            $order = $this->model::where($column, $value)->firstOrFail();
            return $order->delete() ? true : false;
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
    function getOrderRatio()
    {
        try {
            $today = Carbon::today();
            $yesterday = Carbon::yesterday();

            $salesPercentageChange = DB::table($this->model->getTable())
            ->selectRaw("
                    COUNT(*) as total_order,
                    SUM(total_amount_after_discount) as total_sales,
                    SUM(CASE WHEN DATE(created_at) = ? THEN total_amount_after_discount ELSE 0 END) as today_sales,
                    SUM(CASE WHEN DATE(created_at) = ? THEN total_amount_after_discount ELSE 0 END) as yesterday_sales,
                    COUNT(CASE WHEN DATE(created_at) = ? THEN 1 ELSE null END) as today_order_count,
                    COUNT(CASE WHEN DATE(created_at) = ? THEN 1 ELSE null END) as yesterday_order_count,
                    CASE
                        WHEN SUM(CASE WHEN DATE(created_at) = ? THEN total_amount_after_discount ELSE 0 END) > 0
                        THEN ((SUM(CASE WHEN DATE(created_at) = ? THEN total_amount_after_discount ELSE 0 END) - SUM(CASE WHEN DATE(created_at) = ? THEN total_amount_after_discount ELSE 0 END)) / SUM(CASE WHEN DATE(created_at) = ? THEN total_amount_after_discount ELSE 0 END)) * 100
                        ELSE 0
                    END as percentage_change_sales,
                    CASE
                        WHEN COUNT(CASE WHEN DATE(created_at) = ? THEN 1 ELSE null END) > 0
                        THEN ((COUNT(CASE WHEN DATE(created_at) = ? THEN 1 ELSE null END) - COUNT(CASE WHEN DATE(created_at) = ? THEN 1 ELSE null END)) / COUNT(CASE WHEN DATE(created_at) = ? THEN 1 ELSE null END)) * 100
                        ELSE 0
                    END as percentage_change_orders", [
                    $today, $yesterday, // For SUM today and yesterday sales
                    $today, $yesterday, // For COUNT today and yesterday orders
                    $yesterday, $today, $yesterday, $yesterday, // For percentage_change_sales
                    $yesterday, $today, $yesterday, $yesterday// For percentage_change_orders
                ])
                ->first();
            return $salesPercentageChange;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
