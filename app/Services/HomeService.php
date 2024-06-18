<?php

namespace App\Services;

use App\Contracts\HomeServiceInterface;
use App\Repo\ProductRepo;

class HomeService implements HomeServiceInterface
{
    public function __construct(
        private readonly ProductRepo $productRepo
    )
    {}

    /**
     * @param int $num
     *
     * @return array
     */
    public function getLatestProductList(int $num = 4) : array
    {
        $data = $this->productRepo->latest($num);
        return $data ?? [];
    }
}
