<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class UserControllerTest extends WebTestCase
{
    public function testRegister(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/user/login');

        self::assertResponseIsSuccessful();
    }
}
