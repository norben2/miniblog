<?php

declare(strict_types=1);

namespace App\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractEndPoint extends WebTestCase
{
    private array $serverInformations = ['ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'];
    public function testGetResponseFromRequest(string $methode, string $uri, string $payload = ''): Response
    {
        $client = self::createClient();
        $client->request(
            $methode,
            $uri . '.json',
            [],
            [],
            $this->serverInformations,
            $payload,

        );


        return $client->getResponse();
    }
}
