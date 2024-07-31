<?php

namespace App\Services\Admin;

use App\Repo\OrderRepo;
use App\Services\TrafficCacheService;

class DashboardService {

    public function __construct(
        private readonly OrderRepo $orderRepo
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
                        "name" =>  $explodedUri[0],
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

}
