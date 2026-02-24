<?php

namespace App\Interface\Http;

use App\Application\Order\UseCase\CreateOrderUseCase;

class CreateOrderController
{
    private CreateOrderUseCase $useCase;

    public function __construct(CreateOrderUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function create(array $request): void
    {
        $this->useCase->execute(
            (string) ($request['reference'] ?? ''),
            (string) ($request['email'] ?? '')
        );
    }

}
