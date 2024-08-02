<?php

namespace App\Contracts\Admin\Courier;

interface CourierServiceInterface
{
    public function placeOrder(array $orderDetails): array;

    public function getOrderInfo(string $trackingNumber): array;
}
