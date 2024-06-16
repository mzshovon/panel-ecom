<?php

namespace App\Services\Admin;

use App\Contracts\Admin\ProductServiceInterface;
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
    ){}

    /**
     * @return array
     */
    function getProducts() : array
    {
        $data = $this->productRepo->get();
        return $data ?? [];
    }

    /**
     * @return array
     */
    function getProductsVariants(): array
    {
        return $this->variantRepo->get() ?? [];
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
        $data = $this->productRepo->update("id", $id, $this->fillableData($request));
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
            'tentative_delivery_date',
            'weight',
            'height',
            'discount',
            'discount_type',
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
