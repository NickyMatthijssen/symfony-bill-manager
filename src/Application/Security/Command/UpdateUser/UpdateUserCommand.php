<?php

declare(strict_types=1);

namespace App\Application\Security\Command\UpdateUser;

use App\Application\Cqrs\CommandInterface;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<void>
 */
#[AsMessage]
final readonly class UpdateUserCommand implements CommandInterface
{
    public function __construct(
        public string $userIdentifier,
        public string $email,
        public string $firstName,
        public string $lastName,
    ) {
    }
}
