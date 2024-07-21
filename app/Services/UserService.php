<?php

namespace App\Services;
use App\Contracts\UserServiceInterface;
use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use Illuminate\Support\Facades\Session;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly OrderRepo $orderRepo,
    ){}

    /**
     * @return array
     */
    function getDashboardData():array
    {
        return [];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    function getUserOrderList(int $num = 20):array
    {
        return [];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    function placeOrder(array $request): bool
    {
        $cart = Session::get('cart', []);
        if(isset($request['first_name']) && isset($request['last_name'])) {
            $request['name'] = "{$request['first_name']} {$request['last_name']}";
            unset($request['first_name']);
            unset($request['last_name']);
        } else {
            $request['name'] =  auth()->user()->name;
        }
        [$totalQuantity, $totalAmount, $orderProducts] = $this->sumCartData($cart);
        $request['created_by'] = auth()->user()?->id ?: null;
        $request['quantity'] = $totalQuantity;
        $request['total_amount'] = $totalAmount;
        $request['total_discount'] = 0;
        $request['shipping_charge'] = 80;
        $request['total_amount_after_discount'] = $totalAmount + $request['shipping_charge'] - 0;
        $store = $this->orderRepo->create($request);
        if($store) {
            foreach ($orderProducts as $product) {
                $product['order_id'] = $store->id;
                OrderProduct::create($product);
            }
            Session::delete('cart');
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    function getUserInformation():array
    {
        return [];
    }

    /**
     * @return array
     */
    function updateUserInformation():array
    {
        return [];
    }

    /**
     * @return array
     */
    function updateUserBillingDetails():array
    {
        return [];
    }

    private function sumCartData($cart):array
    {
        $totalQuantity = collect($cart)->sum('quantity');
        $totalAmount = 0;
        $orderProducts = [];
        foreach ($cart as $key => $cartData) {
            $totalAmount += ($cartData['quantity'] * $cartData['product']['price']) - 0;
            $orderProducts[] = [
                "product_id" => $cartData['product']['id'],
                "quantity" => $cartData['quantity'],
                "price" => $cartData['product']['price'],
                "created_by" => auth()->user()?->id ?: null,
            ];
        }
        return [$totalQuantity, $totalAmount, $orderProducts];
    }
}
