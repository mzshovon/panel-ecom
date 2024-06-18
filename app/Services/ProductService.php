<?php

namespace App\Services;

use App\Contracts\HomeServiceInterface;
use App\Contracts\ProductServiceInterface;
use App\Repo\ProductRepo;
use Illuminate\Database\Eloquent\Model;

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
     * @param int $id
     *
     * @return Model|null
     */
    public function getSingleProductById(int $id): Model|null
    {
        $data = $this->productRepo->getByColumn("id", $id);
        return $data;
    }
}
