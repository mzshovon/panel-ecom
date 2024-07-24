<?php

namespace App\Contracts\Admin;

use Illuminate\Database\Eloquent\Model;

interface OrderServiceInterface {

    function getOrders():array;
    function getOrderById(int $id) : Model|null;
    function createOrder(array $request) : bool;
    function updateOrder(int $id, array $request) : bool;
    function deleteOrder(int $id) : bool;

}
