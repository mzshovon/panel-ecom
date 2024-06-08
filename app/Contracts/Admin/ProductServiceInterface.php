<?php

namespace App\Contracts\Admin;

use Illuminate\Database\Eloquent\Model;

interface ProductServiceInterface {

    function getProducts():array;
    function getProductById():Model;
    function createProduct():bool;
    function updateProduct():bool;
    function deleteProduct():bool;

}
