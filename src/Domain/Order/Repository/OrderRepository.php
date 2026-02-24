<?php

namespace App\Domain\Order\Repository;

use App\Domain\Order\Entity\Order;

interface OrderRepository
{
    public function save(Order $order): void;
}