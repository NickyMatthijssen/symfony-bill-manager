<?php

declare(strict_types=1);

namespace App\Application\Security\UpdatePassword;

use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler(handles: UpdatePasswordCommand::class)]
final readonly class UpdatePasswordCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function __invoke(UpdatePasswordCommand $command): void
    {
        $user = $this->userRepository->findByUserIdentifier($command->userIdentifier);
        $user->setPassword(
            $this->userPasswordHasher->hashPassword($user, $command->password),
        );

        $this->entityManager->flush();
    }
}
