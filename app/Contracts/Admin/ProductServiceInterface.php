<?php

namespace App\Contracts\Admin;

use Illuminate\Database\Eloquent\Model;

interface ProductServiceInterface {

    function getProducts():array;
    function getProductById(int $id) : Model|null;
    function getProductsVariants() : array;
    function createProduct(array $request) : bool;
    function updateProduct(int $id, array $request) : bool;
    function deleteProduct(int $id) : bool;

}
