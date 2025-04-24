<?php

declare(strict_types=1);

namespace App\Form\Handler\Bill;

use App\Form\Model\Bill\DeleteBill;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DeleteBillHandler
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(DeleteBill $data): void
    {
        $this->entityManager->remove($data->bill);
        $this->entityManager->flush();
    }
}
