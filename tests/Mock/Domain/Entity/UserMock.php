<?php

declare(strict_types=1);

namespace App\Tests\Mock\Domain\Entity;

use App\Domain\Entity\User;
use App\Domain\ValueObject\Base64;

final class UserMock
{
    private function __construct()
    {
    }

    public static function create(
        string $email = 'user@example.com',
        string $firstName = 'first',
        string $lastName = 'last',
    ): User {
        return new User($email, $firstName, $lastName, new Base64('type', 'value'));
    }
}
