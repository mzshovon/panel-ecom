<?php

namespace App\Services;

use App\Contracts\HomeServiceInterface;
use App\Contracts\ProductServiceInterface;
use App\Repo\CategoryRepo;
use App\Repo\ProductRepo;
use Illuminate\Database\Eloquent\Model;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private readonly ProductRepo $productRepo,
        private readonly CategoryRepo $categoryRepo
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

    /**
     * @param int $id
     *
     * @return array
     */
    public function getProductListByCategoryId(int $catId): array
    {
        $data = $this->categoryRepo->getProductsByCategory($catId);
        $products = $data->products ?? [];
        $category = [
            "id" => $data->id,
            "name" => $data->name,
            "status" => $data->status
        ];
        return [$category, $products] ?? [];
    }


    /**
     * @param int $num
     *
     * @return array
     */
    public function searchProducts(string $keywords, int $num = 100) : array
    {
        $data = $this->productRepo->latest($num, $keywords);
        return $data ?? [];
    }
}
