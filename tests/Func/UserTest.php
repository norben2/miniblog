<?php

declare(strict_types=1);

namespace App\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;

class UserTest extends AbstractEndPoint
{
    private string $userPayload = "{'email':'%s','password':'password'}";
    public function testGetUsers(): void
    {

        $response = $this->testGetResponseFromRequest(Request::METHOD_GET, '/api/users');
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    public function testPostUser(): void
    {


        $response = $this->testGetResponseFromRequest(
            Request::METHOD_POST,
            '/api/users',
            $this->getUserPayload()
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);


        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    private function getUserPayload()
    {
        $faker = Factory::create();
        $email = $faker->email;
        return sprintf($this->userPayload, $email);
    }
}
