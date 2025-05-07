<?php

declare(strict_types=1);

namespace App\Application\Transaction\Command\CreateTransaction;

use App\Application\Common\AvatarGeneratorInterface;
use App\Application\Common\FaviconResolverInterface;
use App\Domain\Entity\Transaction;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Doctrine\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(handles: CreateTransactionCommand::class)]
final readonly class CreateTransactionCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private FaviconResolverInterface $faviconResolver,
        private AvatarGeneratorInterface $avatarGenerator,
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function __invoke(CreateTransactionCommand $command): Transaction
    {
        $user = $this->userRepository->findByUserIdentifier($command->userIdentifier);

        $transaction = new Transaction(
            $user,
            $command->name,
            $command->amount,
            $command->interval,
            $command->type,
        );
        $this->setIcon($transaction, $command);

        $user->addTransaction($transaction);
        $this->entityManager->flush();

        return $transaction;
    }

    private function setIcon(Transaction $transaction, CreateTransactionCommand $command): void
    {
        $transaction->setUrl($command->url);
        $transaction->setIcon(
            $command->url !== null
                ? $this->faviconResolver->resolve($command->url)
                : $this->avatarGenerator->generate($command->name),
        );
    }
}
