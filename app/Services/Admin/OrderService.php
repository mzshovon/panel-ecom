<?php

namespace App\Services\Admin;

use App\Contracts\Admin\OrderServiceInterface;
use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use App\Repo\ProductRepo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class OrderService implements OrderServiceInterface
{
    const PRODUCT_STOCK_THRESHOLD = 2;

    function __construct(
        private readonly orderRepo $orderRepo,
        private readonly OrderProduct $orderProductRepo,
        private readonly ProductRepo $productRepo,
    ) {
    }

    /**
     * @return array
     */
    function getOrders(?array $request): array
    {
        $data = [];
        if(!empty($request)) {
            if(isset($request['filter'])) {
                unset($request['filter']);
                $data = $this->orderRepo->filter($request);
            } else if(isset($request['download'])) {
                unset($request['download']);
                $data = $this->orderRepo->filter($request);
            }
        } else {
            $data = $this->orderRepo->get();
        }
        return $data;
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
     * @return array
     */
    function createOrder(array $request): array
    {
        $warningMessage = null;
        $createdBy = auth()->user()->id;
        if(count($request['product_id']) > 0) {
            $orderProductInsertArray = [];

            $products = $request['product_id'];
            $quantities = $request['quantities'];
            $purchaseCost = $request['purchase_cost'];
            $request['created_by'] = $createdBy;

            unset($request['products']);
            unset($request['quantities']);
            unset($request['purchase_cost']);
            unset($request['prices']);

            $order = $this->orderRepo->create($request);

            if($order) {
                [$orderProductInsertArray, $warningMessage] = $this->formatProductOrderDataForStore($products, $quantities, $purchaseCost, $order);
            }

            if(!empty($orderProductInsertArray)) {
                $insertOrderProducts = OrderProduct::insert($orderProductInsertArray);
                return $insertOrderProducts ?
                    [Response::HTTP_OK, "Order saved successfully. $warningMessage"] :
                    [Response::HTTP_NOT_FOUND, "There is something went wrong while creating order"];
            }
        }

        return [Response::HTTP_NOT_FOUND, "Order can't be processed this time"];
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
        $orderedProduct = $this->orderProductRepo->where("id", $orderProductId)->firstOrFail();
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

    /**
     * @param array $products
     * @param array $quantities
     * @param array $purchaseCost
     * @param Model $order
     *
     * @return array
     */
    private function formatProductOrderDataForStore(array $products, array $quantities, array $purchaseCost, Model $order) : array
    {
        $orderProductInsertArray = [];
        $warningMessage = null;
        $createdBy = auth()->user()->id;
        foreach ($products as $index => $productId) {
            $product = $this->productRepo->getByColumn("id", $productId);
            $quantity = $quantities[$index];

            if ($product->stock < $quantity) {
                return [Response::HTTP_NOT_FOUND, 'Not enough stock for ' . $product->name];
            }

            if ($product->stock == 0) {
                return [Response::HTTP_NOT_FOUND, $product->name . ' is out of stock and cannot be ordered.'];
            }

            if (($product->stock - $quantity) <= self::PRODUCT_STOCK_THRESHOLD) {
                $warningMessage .= "{$product->name} stock is low. \n";
            }

            // Create order product record
            $orderProductInsertArray[] = [
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'purchase_cost' => $purchaseCost[$index],
                'created_by' => $createdBy,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        return [$orderProductInsertArray, $warningMessage];
    }
}
