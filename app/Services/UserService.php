<?php

namespace App\Services;
use App\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct()
    {

    }

    /**
     * @return array
     */
    function getDashboardData():array
    {
        return [];
    }

    /**
     * @param int $num
     *
     * @return array
     */
    function getUserOrderList(int $num = 20):array
    {
        return [];
    }

    /**
     * @return array
     */
    function getUserInformation():array
    {
        return [];
    }

    /**
     * @return array
     */
    function updateUserInformation():array
    {
        return [];
    }

    /**
     * @return array
     */
    function updateUserBillingDetails():array
    {
        return [];
    }
}
