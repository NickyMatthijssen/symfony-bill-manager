<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\Bill;
use App\Domain\Repository\BillRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bill>
 */
final class BillRepository extends ServiceEntityRepository implements BillRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bill::class);
    }
}
