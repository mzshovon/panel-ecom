<?php

namespace App\Services\Admin;

use App\Contracts\Admin\ProductServiceInterface;
use Illuminate\Database\Eloquent\Model;

class ProductService implements ProductServiceInterface
{
    function getProducts() : array
    {
        return [];
    }

    function getProductById() : Model
    {
        return new Model();
    }

    function createProduct() : bool
    {
        return true;
    }

    function updateProduct() : bool
    {
        return true;
    }

    function deleteProduct() : bool
    {
        return false;
    }
}
