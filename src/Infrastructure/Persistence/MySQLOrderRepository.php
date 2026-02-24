<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Order\Entity\Order;
use App\Domain\Order\Repository\OrderRepository;
use PDO;

class MySQLOrderRepository implements OrderRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Order $order): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO orders (reference, email)
            VALUES (:reference, :email)
        ");

        $stmt->execute([
            'reference' => $order->getId(),
            'email' => $order->getCustomerEmail()
        ]);
    }
}