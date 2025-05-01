<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Bill;

use App\Domain\Exception\UnexpectedValueException;
use App\Presentation\Form\Model\Bill\DeleteBill;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DeleteBillHandler
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(DeleteBill $data): void
    {
        if (!$data->isConfirmed()) {
            throw new UnexpectedValueException('There should be a confirmation to delete the bill.');
        }

        $this->entityManager->remove($data->getBill());
        $this->entityManager->flush();
    }
}
