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

    public static function create(): User
    {
        return new User('user@example.com', 'first', 'last', new Base64('type', 'value'));
    }
}
