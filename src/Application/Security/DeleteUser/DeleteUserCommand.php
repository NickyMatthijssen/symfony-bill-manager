<?php

declare(strict_types=1);

namespace App\Application\Security\DeleteUser;

use App\Application\Cqrs\CommandInterface;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<void>
 */
#[AsMessage]
final readonly class DeleteUserCommand implements CommandInterface
{
    public function __construct(
        public string $userIdentifier,
    ) {
    }
}
