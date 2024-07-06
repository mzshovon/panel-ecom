<?php

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Repo\ProductRepo;
use Illuminate\Support\Facades\Session;

class CartService implements CartServiceInterface
{
    public function __construct(
        private readonly ProductRepo $productRepo
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
        $cart = Session::get('cart', []);
        if(isset($cart[$request['product_id']])) {
            $cart[$request['product_id']]['quantity'] += $request['quantity'];
            Session::put('cart', $cart);
        } else {
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $request['quantity'],
            ];
        }
        Session::put('cart', $cart);
        return [true, $cart];
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
        return [true, $cart];
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
        return [true, $cart];
    }
}
