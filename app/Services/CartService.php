<?php

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Repo\ProductRepo;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartService implements CartServiceInterface
{
    private string $stockOutMessage = "This product is out of stock";
    private string $stockFilled = "No more unit available for this product";

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
}
