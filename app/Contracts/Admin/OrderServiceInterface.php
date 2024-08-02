<?php

namespace App\Contracts\Admin;

use Illuminate\Database\Eloquent\Model;

interface OrderServiceInterface {

    function getOrders():array;
    function getOrderById(int $id) : Model|null;
    function createOrder(array $request) : array;
    function updateOrder(int $id, array $request) : bool;
    function updateOrderProduct(array $request) : bool;
    function deleteOrder(int $id) : bool;
    function deleteOrderProduct(int $orderProductId) : bool;

}
