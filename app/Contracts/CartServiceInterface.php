<?php

namespace App\Contracts;

interface CartServiceInterface {

    function getCartProducts(int $num = 4):array;
    function addCartProducts(array $request):array;
    function updateCartProducts(array $request):array;
    function deleteCartProducts(array $request):array;

}
