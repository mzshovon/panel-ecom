<?php

namespace App\Services\Admin;

use App\Contracts\Admin\OrderServiceInterface;
use App\Repo\OrderRepo;
use Illuminate\Database\Eloquent\Model;

class OrderService implements OrderServiceInterface
{
    function __construct(
        private readonly OrderRepo $OrderRepo
    ){}

    /**
     * @return array
     */
    function getOrders() : array
    {
        $data = $this->OrderRepo->get();
        return $data ?? [];
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    function getOrderById(int $id) : Model|null
    {
        $data = $this->OrderRepo->getByColumn("id",$id);
        return $data;
    }

    /**
     * @param array $request
     *
     * @return bool
     */
    function createOrder(array $request) : bool
    {
        if(isset($request['password'])) {
            $request['password'] = bcrypt($request['password']);
        }
        $data = $this->OrderRepo->create($request);
        return $data ? true : false;
    }

    /**
     * @param int $id
     * @param array $request
     *
     * @return bool
     */
    function updateOrder(int $id, array $request) : bool
    {
        $request['updated_by'] = auth()->user()->id;
        $data = $this->OrderRepo->update("id", $id, $this->fillableData($request));
        return $data ?? false;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    function deleteOrder(int $id) : bool
    {
        $data = $this->OrderRepo->delete("id", $id);
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
            "quantity",
            "total_amount",
            "total_discount",
            "total_amount_after_discount",
            "shipping_charge",
            "payment_type",
            "name",
            "address",
            "notes",
            "status",
            "updated_by",
        ];
        foreach ($request as $key => $value) {
            if(in_array($key, $fillable)){
                $data[$key] = $value;
            }
        }
        return $data;
    }
}
