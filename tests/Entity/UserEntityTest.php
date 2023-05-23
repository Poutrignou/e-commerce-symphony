<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserEntityTest extends KernelTestCase
{
  
        private const VALID_EMAIL_VALUE = 'thiboodadd@gmail.fr';
        private const VALID_PASSWORD_VALUE = 'Tibotest';
        private const INVALID_PASSWORD_VALUE = '';
        private const INVALID_EMAIL_VALUE = '0';

    public function testUserEntityIsValid() : void
    {
        self::bootKernel();
        $container = static::getContainer();

        $user = new User();
        $user->setEmail(self::VALID_EMAIL_VALUE);
        $user->setPassword(self::VALID_PASSWORD_VALUE);


        $errors = $container->get('validator')->validate($user);

        $this->assertCount(2, $errors);

    }

    public function testUserEntityIsNotValid() : void
    {
        self::bootKernel();
        $container = static::getContainer();

        $user = new User();
        $user->setEmail(self::INVALID_EMAIL_VALUE);
        $user->setPassword(self::INVALID_PASSWORD_VALUE);


        $errors = $container->get('validator')->validate($user);

        $this->assertCount(0, $errors);

    }
}
