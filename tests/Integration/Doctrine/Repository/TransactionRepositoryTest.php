<?php

declare(strict_types=1);

use App\Domain\Entity\Transaction;
use App\Domain\Exception\EntityNotFoundException;
use App\Infrastructure\Doctrine\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

uses(KernelTestCase::class);

test('find a user by their id', function () {
    $transactionRepository = $this->getContainer()->get(TransactionRepository::class);
    $transaction = $transactionRepository->findById(1);

    $this->assertInstanceOf(Transaction::class, $transaction);
    $this->assertEquals(1, $transaction->getId());
});

test('throws an exception if user could not be found by id', function () {
    $this->expectException(EntityNotFoundException::class);
    $this->expectExceptionMessage('Could not find entity "App\Domain\Entity\Transaction" with attribute "id" with value "100"');

    $transactionRepository = $this->getContainer()->get(TransactionRepository::class);
    $transactionRepository->findById(100);
});
