<?php

namespace App\Services;
use App\Contracts\UserServiceInterface;
use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly OrderRepo $orderRepo,
    ){}

    /**
     * @return array
     */
    function getDashboardData():array
    {
        return [];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    function getUserOrderList(int $num = 20):array
    {
        $orders = Auth::user()->orders->toArray();
        return !empty($orders) ? $orders : [];
    }

    /**
     * @return array
     */
    function getUserInformation():array
    {
        return [];
    }

    /**
     * @return array
     */
    function updateUserInformation():array
    {
        return [];
    }

    /**
     * @return array
     */
    function updateUserBillingDetails():array
    {
        return [];
    }
}
