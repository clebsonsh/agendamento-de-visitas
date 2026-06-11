<?php

declare(strict_types=1);

function setupCors(): void
{
    /** @var string */
    $allowedOrigin = $_ENV['CORS_ALLOWED_ORIGIN'] ?? 'http://localhost:3000';

    header("Access-Control-Allow-Origin: {$allowedOrigin}");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Accept');
    header('Access-Control-Max-Age: 86400');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit();
    }
}
