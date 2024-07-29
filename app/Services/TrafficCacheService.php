<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class TrafficCacheService {

    const CACHE_KEY = "traffic";

    /**
     * @param array $data
     * @param string $uri
     *
     * @return void
     */
    public static function store(array $data, string $uri) : void
    {
        $cacheData = [];

        if (Cache::has(self::CACHE_KEY)) {
            $cacheData = json_decode(Cache::get(self::CACHE_KEY), true);
            $cacheData["user_count"] = $cacheData["user_count"] + 1;
            if (isset($cacheData["uri"][$uri])) {
                $cacheData["uri"][$uri] += 1;
            } else {
                $cacheData["uri"][$uri] = 1;
            }
            $cacheData["users"][] = $data;
        } else {
            $cacheData["user_count"] = 1;
            $cacheData["uri"] = [$uri => 1];
            $cacheData["users"] = [$data];
        }
        Cache::put(self::CACHE_KEY, json_encode($cacheData), 120 * 24 * 60 * 60);
    }

    /**
     * @return array
     */
    public static function get() : array
    {
        $cacheData = json_decode(Cache::get(self::CACHE_KEY), true);
        return $cacheData ?? [];
    }

}
