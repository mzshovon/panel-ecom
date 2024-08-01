<?php

namespace App\Services\Admin;

use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use App\Repo\UserRepo;
use App\Services\TrafficCacheService;

class DashboardService {

    public function __construct(
        private readonly OrderRepo $orderRepo,
        private readonly UserRepo $userRepo,
    )
    {

    }

    function getDashboardData() : array
    {
        $data = [];
        [$traffic, $total_traffic] = $this->getTrafficDataSet(TrafficCacheService::get());
        $data['traffic'] = $traffic;
        $data['total_traffic'] = $total_traffic;
        $data['orders'] = $this->getRecentSales();
        $data['sales'] = $this->getSalesDataSet();
        $data['users'] = $this->getUsersDataSet();
        $data['most_sold_products'] = $this->getMostSalesProductList();
        return $data;
    }

    /**
     * @return array
     */
    private function getRecentSales() : array
    {
        $order = $this->orderRepo->get(["*"], 10);
        return $order;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function getTrafficDataSet(array $data) : array
    {
        [$traffic, $total_traffic] = [null, 0];
        $this->getSalesDataSet();
        if(!empty($data)) {
            $total_traffic = $data["user_count"];
            foreach($data['uri'] as $uri => $val) {
                $explodedUri = explode("/", $uri);
                if(isset($explodedUri[0]) && $explodedUri[0]) {
                    $traffic[] = [
                        "value" => $val,
                        "name" =>  ucfirst($explodedUri[0]),
                    ];
                }
                if(empty($explodedUri[0]) && empty($explodedUri[1])) {
                    $traffic[] = [
                        "value" => $val,
                        "name" =>  "Home",
                    ];
                }
            }
            $traffic = json_encode($traffic);
        }
        return [$traffic, $total_traffic];
    }

    private function getSalesDataSet() : array
    {
        $sales = $this->orderRepo->getOrderRatio();
        return (array)$sales;
    }

    private function getUsersDataSet() : array
    {
        $users = $this->userRepo->getUserRatio();
        return (array)$users;
    }

    private function getMostSalesProductList() : array
    {
        $roderProducts = (new OrderProduct)->getMostSoldProducts();
        return $roderProducts;
    }

}
