<?php

declare(strict_types=1);

namespace App\Application\Security\UpdatePassword;

use App\Application\Cqrs\CommandInterface;
use App\Domain\Entity\User;
use SensitiveParameter;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<void>
 */
#[AsMessage]
final readonly class UpdatePasswordCommand implements CommandInterface
{
    public function __construct(
        public string $userIdentifier,
        #[SensitiveParameter]
        public string $password,
    ) {
    }
}
