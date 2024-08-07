<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderPlaceRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        public UserServiceInterface $repo
    ){}

    public function dashboard()
    {
        try {
            $data = [];
            $data = $this->repo->getDashboardData();
            return view('frontend.user.dashboard', $data);
        } catch (\Exception $ex) {
            abort(Response::HTTP_NOT_FOUND, "Sorry No Data Found!");
        }
    }

    public function orders()
    {
        try {
            $data = [];
            $data['orders'] = customPaginate($this->repo->getUserOrderList(), 10);
            return view('frontend.user.orders', $data);
        } catch (\Exception $ex) {
            abort(Response::HTTP_NOT_FOUND, "Sorry No Data Found!");
        }
    }

    public function orderDetails(int $id)
    {
        try {
            $data = [];
            $data['order'] =$this->repo->getOrderInformation($id);
            return view('frontend.user.order-view', $data);
        } catch (\Exception $ex) {
            abort(Response::HTTP_NOT_FOUND, "Sorry No Data Found!");
        }
    }

    public function review(Request $request)
    {
        try {
            $store =$this->repo->review($request->all());
            if($store) {
                return redirect()->back()->with("success", "Your review has been submitted successfully!");
            } else {
                return redirect()->back()->with("error", "Something went wrong!");
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
}
