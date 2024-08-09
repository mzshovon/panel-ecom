<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    const INDEX_PAGE = "Products";
    const CREATE_PAGE = "Create Products";
    const UPDATE_PAGE = "Update Products";

    public function __construct(private ProductServiceInterface $repo){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = [];
            $data['page'] = self::INDEX_PAGE;
            $data['products'] = customPaginate($this->repo->getProducts($request->all()), 10);
            return view('admin.product.view', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = [];
            $data['page'] = self::CREATE_PAGE;
            $data['variants'] = $this->repo->getProductsVariants();
            $data['categories'] = $this->repo->getCategories();
            $data['sections'] = config('product.sections');
            return view('admin.product.create', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $store = $this->repo->createProduct($request->all());
            return redirect()->back()->with("success", "Product {$request['name']} has been created successfully!");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $data = [];
            $data['page'] = self::UPDATE_PAGE;
            return view('admin.product.create', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try {
            $data = [];
            $data['page'] = self::UPDATE_PAGE;
            $data['variants'] = $this->repo->getProductsVariants();
            $data['categories'] = $this->repo->getCategories();
            $data['product'] = $this->repo->getProductById($id);
            $data['sections'] = config('product.sections');
            return view('admin.product.edit', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, int $id)
    {
        try {
            $update = $this->repo->updateProduct($id, $request->all());
            if($update) {
                return redirect()->back()->with("success", "Product named {$request['name']} info is updated successfully!");
            } else {
                return redirect()->back()->with("error", "Something went wrong while updating {$request['name']} info!");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Update the status specified resource in storage.
     */
    public function statusChange(Request $request, int $id)
    {
        try {
            $update = $this->repo->updateProduct($id, $request->all());
            if($update) {
                return response()->json([($update ? 'success' : 'error') =>
                    ($update ? 'Product status changed successfully.' : 'something went wrong with chage the status')]);
            }
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $delete = $this->repo->deleteProduct($id);
            return response()->json([($delete ? 'success' : 'error') =>
                    ($delete ? 'Product deleted successfully.' : 'something went wrong with delete')]);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
}
