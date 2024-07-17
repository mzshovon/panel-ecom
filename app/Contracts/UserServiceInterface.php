<?php

namespace App\Contracts;

interface UserServiceInterface {
    function getDashboardData():array;
    function getUserOrderList(int $num = 20):array;
    function getUserInformation():array;
    function updateUserInformation():array;
    function updateUserBillingDetails():array;
}
