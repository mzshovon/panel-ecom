<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ProductServiceInterface {

    function getProductList(int $num = 4):array;
    function getSingleProductById(int $id):Model|null;
    function getProductListByCategoryId(int $catId):array;
    function searchProducts(string $keywords, int $num = 100):array;

}
