<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\Transaction;
use App\Domain\Exception\EntityNotFoundException;
use App\Domain\Repository\TransactionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transaction>
 */
final class TransactionRepository extends ServiceEntityRepository implements TransactionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function findById(int $id): Transaction
    {
        $transaction = $this->find($id);
        if (null === $transaction) {
            throw EntityNotFoundException::couldNotBeFoundByAttribute($this->getEntityName(), 'id', $id);
        }

        return $transaction;
    }
}
