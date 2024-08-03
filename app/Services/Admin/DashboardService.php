<?php

namespace App\Services\Admin;

use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use App\Repo\UserRepo;
use App\Services\TrafficCacheService;
use App\Services\Wrapper\HttpCallService;
use Illuminate\Support\Facades\Cache;

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
        $data['latest_news'] = $this->getLatestNews();
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

    /**
     * @return array
     */
    private function getSalesDataSet() : array
    {
        $sales = $this->orderRepo->getOrderRatio();
        return (array)$sales;
    }

    /**
     * @return array
     */
    private function getUsersDataSet() : array
    {
        $users = $this->userRepo->getUserRatio();
        return (array)$users;
    }

    /**
     * @return array
     */
    private function getMostSalesProductList() : array
    {
        $orderProducts = (new OrderProduct)->getMostSoldProducts();
        return $orderProducts;
    }

    /**
     * @return array
     */
    private function getLatestNews() : array
    {
        $news = [];
        if(Cache::has("latest_news")) {
            $news = json_decode(Cache::get("latest_news"), true);
        } else {
            $url = config('website.api.news.endpoint');
            $queryParams = [
                "country" => "bd",
                "apikey" => config('website.api.news.api_key'),
            ];
            $response = (new HttpCallService)->get($url, $queryParams);
            if(!empty($response) && isset($response['results'])) {
                $news = $this->getBdNewsOnly($response['results']);
                Cache::put("latest_news", json_encode($news), 2 * 60 * 60);
            }
        }
        return $news;
    }

    /**
     * @param array $results
     *
     * @return array
     */
    private function getBdNewsOnly(array $results) : array
    {
        $filteredNews = collect($results)->filter(function ($item) {
            return isset($item['country']) && count($item['country']) === 1 && strtolower($item['country'][0]) === 'bangladesh';
        })->toArray();
        return $filteredNews;
    }

}
