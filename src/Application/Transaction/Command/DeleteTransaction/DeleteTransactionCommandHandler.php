<?php

declare(strict_types=1);

namespace App\Application\Transaction\Command\DeleteTransaction;

use App\Domain\Repository\TransactionRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(handles: DeleteTransactionCommand::class)]
final readonly class DeleteTransactionCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private TransactionRepositoryInterface $transactionRepository,
    ) {
    }

    public function __invoke(DeleteTransactionCommand $command): void
    {
        $this->entityManager->remove(
            $this->transactionRepository->findById($command->transactionId),
        );
        $this->entityManager->flush();
    }
}
