<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\ProductServiceInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(
        public ProductServiceInterface $repo
    )
    {

    }
    function productList()
    {

    }

    function singleProduct($id)
    {
        $data = [];
        $data['product'] = $this->repo->getSingleProductById($id);
        if($data['product']) {
            return view('frontend.products.single.single', $data);
        }
        abort(Response::HTTP_NOT_FOUND, "Sorry Product Not Found!");
    }
}
