<?php

namespace App\Contracts;

interface UserServiceInterface {
    function getDashboardData():array;
    function getUserOrderList(int $num = 20):array;
    function placeOrder(array $request):bool;
    function getUserInformation():array;
    function updateUserInformation():array;
    function updateUserBillingDetails():array;
}
