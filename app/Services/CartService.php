<?php

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use App\Repo\ProductRepo;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartService implements CartServiceInterface
{
    private string $stockOutMessage = "This product is out of stock";
    private string $stockFilled = "No more unit available for this product";

    public function __construct(
        private readonly ProductRepo $productRepo,
        private readonly OrderRepo $orderRepo
    )
    {}

    /**
     * @param int $num
     *
     * @return array
     */
    public function getCartProducts(int $num = 4) : array
    {
        $cart = Session::get('cart', []);
        return $cart ?? [];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    public function addCartProducts(array $request) : array
    {
        $product = $this->productRepo->getByColumn("id", $request['product_id']);
        if($product->stock == 0) {
            return [Response::HTTP_BAD_REQUEST, $this->stockOutMessage, []];
        }
        $cart = Session::get('cart', []);
        if(isset($cart[$request['product_id']])) {
            $cart[$request['product_id']]['quantity'] += $request['quantity'];
            if($cart[$request['product_id']]['quantity'] >= $product->stock) {
                return [Response::HTTP_BAD_REQUEST, $this->stockFilled, []];
            }
            Session::put('cart', $cart);
        } else {
            if($request['quantity'] >= $product->stock) {
                return [Response::HTTP_BAD_REQUEST, $this->stockFilled, []];
            }
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $request['quantity'],
            ];
        }
        Session::put('cart', $cart);
        return [Response::HTTP_OK, "Product added to cart!", $cart];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    public function updateCartProducts(array $request) : array
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$request['product_id']])) {
            $cart[$request['product_id']]['quantity'] = $request['quantity'];
            Session::put('cart', $cart);
        }
         return [Response::HTTP_OK, "Product added to cart!", $cart];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    public function deleteCartProducts(array $request) : array
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$request['product_id']])) {
            unset($cart[$request['product_id']]);
            Session::put('cart', $cart);
        }
         return [Response::HTTP_OK, "Product removed from cart!", $cart];
    }


    /**
     * @param array $request
     *
     * @return bool
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
            Session::forget('cart');
            return true;
        }
        return false;
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
