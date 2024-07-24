<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\OrderServiceInterface;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const INDEX_PAGE = "Orders";
    const CREATE_PAGE = "Create Orders";
    const UPDATE_PAGE = "Update Orders";

    public function __construct(private OrderServiceInterface $repo){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [];
            $data['page'] = self::INDEX_PAGE;
            $data['orders'] = customPaginate($this->repo->getOrders(), 10);
            $data['orderStatus'] = array_column(StatusEnum::cases(), 'value');
            return view('admin.order.view', $data);
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
            $data['orderStatus'] = array_column(StatusEnum::cases(), 'value');
            return view('admin.order.create', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request)
    {
        try {
            $store = $this->repo->createOrder($request->all());
            return redirect()->back()->with("success", "Order {$request['name']} has been created successfully!");
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
            return view('admin.order.create', $data);
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
            $data['order'] = $this->repo->getOrderById($id);
            $data['orderStatus'] = array_column(StatusEnum::cases(), 'value');
            return view('admin.order.edit', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, int $id)
    {
        try {
            $update = $this->repo->updateOrder($id, $request->all());
            if($update) {
                return redirect()->back()->with("success", "Order id #{$id} info is updated successfully!");
            } else {
                return redirect()->back()->with("error", "Something went wrong while updating #{$id} info!");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Update the status specified resource in storage.
     */
    public function statusChange(Request $request)
    {
        try {
            $id = $request->order_id ?? null;
            if(!$id) {
                return redirect()->back()->with("error", "Invalid/Missing order id!");
            }
            $update = $this->repo->updateOrder($id, $request->all());
            if($update) {
                return redirect()->back()->with("success", "Order status successfully changed to {$request['status']}!");
            } else {
                return redirect()->back()->with("error", "Something went wrong!");
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
            $delete = $this->repo->deleteOrder($id);
            return response()->json([($delete ? 'success' : 'error') =>
                    ($delete ? 'Order deleted successfully.' : 'something went wrong with delete')]);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
}
