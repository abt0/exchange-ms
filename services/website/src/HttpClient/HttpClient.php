<?php

declare(strict_types=1);

namespace App\HttpClient;

use Psr\Http\Message\ResponseInterface;

interface HttpClient
{
    public function get(string $url): ResponseInterface;
}
