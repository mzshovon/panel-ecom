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
            $data['userData'] = $this->repo->getDashboardData();
            return view('frontend.user.dashboard', $data);
        } catch (\Exception $ex) {
            abort(Response::HTTP_NOT_FOUND, "Sorry No Data Found!");
        }
    }

    public function orders()
    {
        try {
            $data = [];
            $data['orders'] = $this->repo->getUserOrderList();
            return view('frontend.user.orders', $data);
        } catch (\Exception $ex) {
            abort(Response::HTTP_NOT_FOUND, "Sorry No Data Found!");
        }
    }
}
