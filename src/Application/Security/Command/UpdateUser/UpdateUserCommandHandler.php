<?php

declare(strict_types=1);

namespace App\Application\Security\Command\UpdateUser;

use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(handles: UpdateUserCommand::class)]
final readonly class UpdateUserCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(UpdateUserCommand $command): void
    {
        $user = $this->userRepository->findByUserIdentifier($command->userIdentifier);
        $user->setEmail($command->email);
        $user->setFirstName($command->firstName);
        $user->setLastName($command->lastName);

        $this->entityManager->flush();
    }
}
