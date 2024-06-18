<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HomeServiceInterface {

    function getLatestProductList(int $num = 4):array;

}
