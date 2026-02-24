<?php

namespace App\Application\Order\UseCase;

use App\Domain\Order\Entity\Order;
use App\Domain\Order\Repository\OrderRepository;
use App\Domain\Order\ValueObject\OrderId;

class CreateOrderUseCase
{
    private OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $reference, string $email): void
    {
        $orderId = new OrderId($reference);

        $order = new Order($orderId, $email);

        $this->repository->save($order);
    }
}
