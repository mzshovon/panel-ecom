<?php

namespace App\Services;

use App\Contracts\HomeServiceInterface;
use App\Contracts\ProductServiceInterface;
use App\Repo\ProductRepo;

class ProductService implements ProductServiceInterface
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
    public function getProductList(int $num = 4): array
    {
        $data = $this->productRepo->latest($num);
        return $data ?? [];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    public function getSingleProductById(int $id): array
    {
        $data = $this->productRepo->latest($id);
        return $data ?? [];
    }
}
