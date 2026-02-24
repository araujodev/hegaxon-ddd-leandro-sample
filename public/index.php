<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST' && $path === '/orders') {
    header('Content-Type: application/json; charset=utf-8');
    try {
        $input = json_decode((string) file_get_contents('php://input'), true) ?? [];
        $pdo = new PDO(
            'mysql:host=db;dbname=app_db',
            'app_user',
            'secret',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        $repository = new \App\Infrastructure\Persistence\MySQLOrderRepository($pdo);
        $useCase = new \App\Application\Order\UseCase\CreateOrderUseCase($repository);
        $controller = new \App\Interface\Http\CreateOrderController($useCase);
        $controller->create($input);

        http_response_code(201);
        echo json_encode(['created' => true], JSON_UNESCAPED_UNICODE);
    } catch (Throwable $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    return;
}

http_response_code(404);
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['error' => 'Not Found'], JSON_UNESCAPED_UNICODE);
