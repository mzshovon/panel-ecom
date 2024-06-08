<?php

namespace App\Repo;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

final readonly class ProductRepo
{
    private Model $model;

    function __construct(private Product $product)
    {
        $this->model = $product;
    }
}
