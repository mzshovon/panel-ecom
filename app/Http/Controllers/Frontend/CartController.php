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
        // return view('cart.index', compact('cart'));
        return response()->json(['success' => 'items found', 'cart' => $cart, 'image_path' => URL::to('/')]);
    }

    public function add(Request $request)
    {

        [$message, $cartData] = $this->repo->addCartProducts($request->all());
        return response()->json(['success' => $message, 'cart' => $cartData, 'image_path' => URL::to('/')]);
    }

    public function update(Request $request)
    {
        [$message, $cartData] = $this->repo->updateCartProducts($request->all());
        return response()->json(['success' => $message, 'cart' => $cartData, 'image_path' => URL::to('/')]);
    }

    public function remove(Request $request)
    {
        [$message, $cartData] = $this->repo->deleteCartProducts($request->all());
        return response()->json(['success' => $message, 'cart' => $cartData, 'image_path' => URL::to('/')]);
    }
}
