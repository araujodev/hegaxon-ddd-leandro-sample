<?php

namespace App\Domain\Order\Entity;

use App\Domain\Order\ValueObject\OrderId;

class Order
{
    private OrderId $orderId;
    private string $customerEmail;
    public function __construct(OrderId $orderId, string $customerEmail)
    {
        $this->orderId = $orderId;
        $this->setCustomerEmail($customerEmail);
    }

    private function setCustomerEmail($email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email inválido");
        }

        $this->customerEmail = $email;
    }

    public function getId(): string
    {
        return $this->orderId->value();
    }

    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

}