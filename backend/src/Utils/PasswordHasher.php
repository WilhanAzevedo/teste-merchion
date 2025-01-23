<?php

namespace App\Utils;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;

class PasswordHasher
{

    public static function hash(string $password): string
    {
        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt'],
        ]);

        $hasher = $factory->getPasswordHasher('common');

        return $hasher->hash($password);
    }

    public static function verify(string $password, string $hash): bool
    {
        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt'],
        ]);

        $hasher = $factory->getPasswordHasher('common');

        return $hasher->verify($hash, $password);
    }
  
}