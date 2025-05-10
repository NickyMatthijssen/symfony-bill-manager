<?php

declare(strict_types=1);

namespace App\Application\Security\Command\SignUp;

use App\Application\Cqrs\CommandInterface;
use SensitiveParameter;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<void>
 */
#[AsMessage]
final readonly class SignUpCommand implements CommandInterface
{
    public function __construct(
        public string $email,
        public string $firstName,
        public string $lastName,
        #[SensitiveParameter]
        public string $password,
    ) {
    }
}
