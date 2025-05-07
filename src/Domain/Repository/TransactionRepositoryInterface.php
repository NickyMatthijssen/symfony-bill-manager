<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Transaction;

interface TransactionRepositoryInterface
{
    public function findById(int $id): Transaction;
}
