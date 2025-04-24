<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Bill;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bill>
 */
class BillRepository extends ServiceEntityRepository implements BillRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bill::class);
    }
}
