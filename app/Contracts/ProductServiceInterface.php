<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ProductServiceInterface {

    function getProductList(int $num = 4):array;
    function getSingleProductById(int $id):Model|null;

}
