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

    function porductsByCategory(int $id)
    {
        try {
            $data = [];
            [$category, $products] = $this->repo->getProductListByCategoryId($id);
            $data['category'] = $category;
            $data['products'] = customPaginate($products, 10);
            return view('frontend.products.category-products', $data);
        } catch (Exception $ex) {
            abort(Response::HTTP_NOT_FOUND, "Sorry Category Not Found!");
        }
    }

    public function search(Request $request)
    {
        $keywords = $request->get("keywords") ?? null;
        if(!$keywords) {
            abort(404, "Please input valid keywords!");
        }
        $data['products'] = customPaginate($this->repo->searchProducts($keywords), 10);
        $data['keywords'] = $keywords;
        return view('frontend.products.category-products', $data);
    }

    public function storeProductReview(Request $request)
    {
        $keywords = $request->get("keywords") ?? null;
        if(!$keywords) {
            abort(404, "Please input valid keywords!");
        }
        $data['products'] = customPaginate($this->repo->searchProducts($keywords), 10);
        $data['keywords'] = $keywords;
        return view('frontend.products.category-products', $data);
    }
}
