<?php

namespace App\Domain\Order\ValueObject;

class OrderId
{
    private string $value;

    public function __construct(string $value)
    {
        if(empty($value)) {
            throw new \InvalidArgumentException("Order id is empty");
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

}