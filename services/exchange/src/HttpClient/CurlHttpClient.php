<?php

declare(strict_types=1);

namespace App\HttpClient;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class CurlHttpClient implements HttpClient
{
    public function get(string $url): ResponseInterface
    {
        $client = new Client();
        return $client->request('GET', $url);
    }
}
