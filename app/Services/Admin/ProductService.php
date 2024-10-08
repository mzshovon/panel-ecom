<?php

namespace App\Services\Admin;

use App\Contracts\Admin\ProductServiceInterface;
use App\Repo\CategoryRepo;
use App\Repo\ProductImagesRepo;
use App\Repo\ProductRepo;
use App\Repo\VariantRepo;
use Illuminate\Database\Eloquent\Model;

class ProductService implements ProductServiceInterface
{
    protected string $imagePath = "storage/img/payment/{id}/";

    function __construct(
        private readonly ProductRepo $productRepo,
        private readonly VariantRepo $variantRepo,
        private readonly ProductImagesRepo $productImagesRepo,
        private readonly CategoryRepo $categoryRepo,
    ){}

    /**
     * @return array
     */
    function getProducts(array $request = []) : array
    {
        $data = [];
        if(!empty($request) && !isset($request['page'])) {
            if(isset($request['filter'])) {
                unset($request['filter']);
                $data = $this->productRepo->filter($request);
            } else if(isset($request['download'])) {
                unset($request['download']);
                $data = $this->productRepo->filter($request);
            }
        } else {
            $data = $this->productRepo->get();
        }
        return $data;
    }

    /**
     * @return array
     */
    function getProductsVariants(): array
    {
        return $this->variantRepo->get() ?? [];
    }

    /**
     * @return array
     */
    function getCategories(): array
    {
        return $this->categoryRepo->get() ?? [];
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    function getProductById(int $id) : Model|null
    {
        $data = $this->productRepo->getByColumn("id",$id);
        return $data;
    }

    /**
     * @param array $request
     *
     * @return bool
     */
    function createProduct(array $request) : bool
    {
        $uploadedImages = [];
        if(isset($request['images'])) {
            $uploadedImages = $request['images'];
            unset($request['images']);
        }
        if(isset($request['variants'])) {
            $request['variants'] = json_encode($request['variants']);
        }
        $data = $this->productRepo->create($request);
        if($data) {
            if(isset($request['categories'])) {
                $data->categories()->attach($request['categories']);
            }
            $productImagesPath = $this->uploadImageandGetImageDir($uploadedImages, $data->id);
            if(!empty($productImagesPath)) {
                $productImageRepo = $this->productImagesRepo;
                $storeImages = collect($productImagesPath)->map(function($image) use ($productImageRepo) {
                    $productImageRepo->create($image);
                });
                return $storeImages ? true : false;
            }
        }
        return false;
    }

    /**
     * @param int $id
     * @param array $request
     *
     * @return bool
     */
    function updateProduct(int $id, array $request) : bool
    {
        if(isset($request['variants'])) {
            $request['variants'] = json_encode($request['variants']);
        }
        $data = $this->productRepo->update("id", $id, $this->fillableData($request));
        if(isset($request['categories'])) {
            $product = $this->productRepo->getByColumn("id", $id);
            $product->categories()->sync($request['categories']);
        }
        return $data ?? false;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    function deleteProduct(int $id) : bool
    {
        $data = $this->productRepo->delete("id", $id);
        return $data ?? false;
    }

    /**
     * @param array $images
     * @param int $productId
     *
     * @return array
     */
    private function uploadImageandGetImageDir(array $images, int $productId) : array
    {
        $data = [];
        foreach ($images as $key => $image) {
            $imgPath = str_replace("{id}", $productId, $this->imagePath);
            $data[] = [
                "image_path" => storeOrUpdateImage($imgPath, $image, $image->getClientOriginalName()),
                "product_id" => $productId
            ];
        }
        return $data;
    }

    /**
     * @param array $request
     *
     * @return array
     */
    private function fillableData(array $request) : array
    {
        $data = [];
        $fillable = [
            'name',
            'description',
            'short_description',
            'sku',
            'stock',
            'price',
            'previous_price',
            'purchase_cost',
            'tentative_delivery_date',
            'weight',
            'height',
            'variants',
            'discount',
            'discount_type',
            'discount_level',
            'sections',
            'created_by',
            'updated_by'
        ];
        foreach ($request as $key => $value) {
            if(in_array($key, $fillable)){
                $data[$key] = $value;
            }
        }
        return $data;
    }
}
