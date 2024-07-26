<?php

namespace App\Services;
use App\Contracts\UserServiceInterface;
use App\Models\OrderProduct;
use App\Models\Review;
use App\Repo\OrderRepo;
use Illuminate\Database\Eloquent\Model;
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
     * @param int $id
     *
     * @return Model
     */
    function getOrderInformation(int $id):Model
    {
        return $this->orderRepo->getByColumn("id", $id);
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

    function review(array $request): bool
    {
        $request['user_id'] = auth()->user()->id;
        $request['rating'] = $request['rate'];
        $store = Review::create($request);
        return $store ? true : false;
    }
}
