<?php

declare(strict_types=1);

namespace App\Application\Security\UpdatePassword;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler(handles: UpdatePasswordCommand::class)]
final readonly class UpdatePasswordCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {
    }

    public function __invoke(UpdatePasswordCommand $command): void
    {
        $command->user->setPassword(
            $this->userPasswordHasher->hashPassword($command->user, $command->password),
        );

        $this->entityManager->persist($command->user);
        $this->entityManager->flush();
    }
}
