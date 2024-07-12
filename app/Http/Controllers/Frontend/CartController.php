<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\CartServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    public function __construct(private CartServiceInterface $repo){}

    public function index()
    {
        $cart = $this->repo->getCartProducts();
        return response()->json(['message' => 'items found', 'cart' => $cart, 'image_path' => URL::to('/')]);
    }

    public function viewCart()
    {
        $data['carts'] = $this->repo->getCartProducts();
        return view('frontend.cart.view', $data);
    }

    public function checkout()
    {
        $data['carts'] = $this->repo->getCartProducts();
        return view('frontend.cart.checkout', $data);
    }

    public function add(Request $request)
    {
        [$statusCode, $message, $cartData] = $this->repo->addCartProducts($request->all());
        return response()->json(['message' => $message, 'cart' => $cartData, 'image_path' => URL::to('/')], $statusCode);
    }

    public function update(Request $request)
    {
        [$statusCode, $message, $cartData] = $this->repo->updateCartProducts($request->all());
        return response()->json(['message' => $message, 'cart' => $cartData, 'image_path' => URL::to('/')], $statusCode);
    }

    public function remove(Request $request)
    {
        [$statusCode, $message, $cartData] = $this->repo->deleteCartProducts($request->all());
        return response()->json(['message' => $message, 'cart' => $cartData, 'image_path' => URL::to('/')], $statusCode);
    }
}
