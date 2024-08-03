<?php

namespace App\Services\Admin;

use App\Models\OrderProduct;
use App\Repo\OrderRepo;
use App\Repo\UserRepo;
use App\Services\TrafficCacheService;
use App\Services\Wrapper\HttpCallService;
use Illuminate\Support\Facades\Cache;

class DashboardService {

    const RECENT_SALES_TTL = 0.5 * 60 * 60;
    const MOST_SALES_TTL = 0.5 * 60 * 60;
    const NEWS_TTL = 2 * 60 * 60;

    public function __construct(
        private readonly OrderRepo $orderRepo,
        private readonly UserRepo $userRepo,
    ){}

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
        $order = [];
        if(Cache::has("recent_sales")) {
            $order = json_decode(Cache::get("recent_sales"), true);
        } else {
            $order = $this->orderRepo->get(["*"], 10);
            Cache::put("recent_sales", json_encode($order), self::RECENT_SALES_TTL);
        }
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
        $orderProducts = [];
        if(Cache::has("most_sales")) {
            $orderProducts = json_decode(Cache::get("most_sales"));
        } else {
            $orderProducts = (new OrderProduct)->getMostSoldProducts();
            Cache::put("most_sales", json_encode($orderProducts), self::MOST_SALES_TTL);
        }
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
                Cache::put("latest_news", json_encode($news), self::NEWS_TTL);
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
