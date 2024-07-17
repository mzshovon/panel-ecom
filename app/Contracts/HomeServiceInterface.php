<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HomeServiceInterface {

    function getLatestProductList(int $num = 4):array;
    function getUpcomingProducts(int $num = 3):array;
    function storeContactUs(array $request):bool;
}
