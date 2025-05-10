<?php

declare(strict_types=1);

use App\Application\Transaction\Command\DeleteTransaction\DeleteTransactionCommand;
use App\Application\Transaction\Command\DeleteTransaction\DeleteTransactionCommandHandler;
use App\Domain\Repository\TransactionRepositoryInterface;
use App\Tests\Mock\Domain\Entity\TransactionMock;
use Doctrine\ORM\EntityManagerInterface;

test('a transaction can be deleted', function () {
    $transaction = TransactionMock::create();

    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('remove')->with($transaction);
    $entityManager->expects($this->once())->method('flush');

    $transactionRepository = $this->createMock(TransactionRepositoryInterface::class);
    $transactionRepository->expects($this->once())->method('findById')->with(12)->willReturn($transaction);

    $handler = new DeleteTransactionCommandHandler($entityManager, $transactionRepository);
    $handler(
        new DeleteTransactionCommand(12),
    );
});
