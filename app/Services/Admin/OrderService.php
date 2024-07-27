<?php

namespace App\Services\Admin;

use App\Contracts\Admin\OrderServiceInterface;
use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderService implements OrderServiceInterface
{
    function __construct(
        private readonly orderRepo $orderRepo,
        private readonly OrderProduct $orderProductRepo
    ) {
    }

    /**
     * @return array
     */
    function getOrders(): array
    {
        $data = $this->orderRepo->get();
        return $data ?? [];
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    function getOrderById(int $id): Model|null
    {
        $data = $this->orderRepo->getByColumn("id", $id);
        return $data;
    }

    /**
     * @param array $request
     *
     * @return bool
     */
    function createOrder(array $request): bool
    {
        $request['created_by'] = auth()->user()->id;
        $data = $this->orderRepo->create($request);
        return $data ? true : false;
    }

    /**
     * @param int $id
     * @param array $request
     *
     * @return bool
     */
    function updateOrder(int $id, array $request): bool
    {
        if (
            isset($request['prev_status']) &&
            isset($request['status']) &&
            $request['prev_status'] != $request['status']
        ) {
            $map = [
                "new_status" => $request['status'],
                "prev_status" => $request['prev_status'],
                "status_changed_by" => auth()->user()->name,
                "status_changed_at" => Carbon::now()->format("M d, Y h:i:s a"),
            ];
            $order = $this->orderRepo->getByColumn("id", $id);
            if($order->status_update_info) {
                $request["status_update_info"] = json_encode($this->decodeAndAddMatrixToMap($order->status_update_info, $map));
            } else {
                $request["status_update_info"] = json_encode([$map]);
            }
        }
        $request['updated_by'] = auth()->user()->id;
        $data = $this->orderRepo->update("id", $id, $this->fillableData($request));
        return $data ?? false;
    }

    /**
     * @param int $id
     * @param array $request
     *
     * @return bool
     */
    function updateOrderProduct(array $request): bool
    {
        $updatedBy = auth()->user()->id;
        $orderedProductId = $request['product_id'];
        $orderedProduct = $this->orderProductRepo->find($orderedProductId);
        $orderedProduct->quantity = $request['quantity'];
        $orderedProduct->updated_by = $updatedBy;

        if ($orderedProduct->update()) {
            $order = $this->orderRepo->getByColumn("id", $request['order_id']);
            // Data wrapper to be updated
            $columnsToBeSaved = [];
            $columnsToBeSaved['updated_by'] = $updatedBy;
            $columnsToBeSaved['quantity'] = $request['total_quantity'];
            $columnsToBeSaved['total_amount'] = $request['total_amount'];
            $columnsToBeSaved['total_amount_after_discount'] = $request['total_amount'] + $order->shipping_charge;
            $data = $this->orderRepo->update("id", $request['order_id'], $this->fillableData($columnsToBeSaved));
            return $data ?? false;
        }
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    function deleteOrder(int $id): bool
    {
        $data = $this->orderRepo->delete("id", $id);
        return $data ?? false;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    function deleteOrderProduct(int $orderProductId): bool
    {
        $columnsToBeUpdated = [];
        $updatedBy = auth()->user()->id;
        $orderedProduct = $this->orderProductRepo->find($orderProductId);
        $orderId = $orderedProduct->order_id;
        $deletedQuantity = $orderedProduct->quantity;
        $deletedAmount = $deletedQuantity * $orderedProduct->price;
        if ($orderedProduct->delete()) {
            $order = $this->orderRepo->getByColumn("id", $orderId);
            $columnsToBeUpdated['updated_by'] = $updatedBy;
            $columnsToBeUpdated['quantity'] = $order->quantity - $deletedQuantity;
            $columnsToBeUpdated['total_amount'] = $order->total_amount - $deletedAmount;
            $columnsToBeUpdated['total_amount_after_discount'] = $order->total_amount - $deletedAmount + $order->shipping_charge;
            $data = $this->orderRepo->update("id", $orderId, $this->fillableData($columnsToBeUpdated));
            return $data ?? false;
        }
        $data = $this->orderRepo->delete("id", $orderProductId);
        return $data ?? false;
    }

    /**
     * @param array $request
     *
     * @return array
     */
    private function fillableData(array $request): array
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
            "status_update_info",
            "invoice_no",
            "merchant_id",
            "courier",
            "order_from",
            "updated_by",
        ];
        foreach ($request as $key => $value) {
            if (in_array($key, $fillable)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }

    /**
     * @param string $statusMap
     * @param array $newMap
     *
     * @return array
     */
    private function decodeAndAddMatrixToMap(string $statusMap, array $newMap) : array
    {
        $decodedStatusMapArray = json_decode($statusMap, true);
        $decodedStatusMapArray[] = $newMap;
        return $decodedStatusMapArray;
    }
}
