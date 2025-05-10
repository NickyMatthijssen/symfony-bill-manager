<?php

declare(strict_types=1);

namespace App\Application\Security\Command\DeleteUser;

use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(handles: DeleteUserCommand::class)]
final readonly class DeleteUserCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(DeleteUserCommand $command): void
    {
        $this->entityManager->remove(
            $this->userRepository->findByUserIdentifier($command->userIdentifier),
        );
        $this->entityManager->flush();
    }
}
