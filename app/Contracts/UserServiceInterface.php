<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface {
    function getDashboardData():array;
    function getUserOrderList(int $num = 20):array;
    function getUserInformation():array;
    function getOrderInformation(int $id):Model;
    function updateUserInformation():array;
    function updateUserBillingDetails():array;
}
