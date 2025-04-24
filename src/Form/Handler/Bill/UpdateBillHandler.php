<?php

declare(strict_types=1);

namespace App\Form\Handler\Bill;

use App\Entity\Bill;
use App\Form\Model\Bill\UpdateBill;
use App\Service\FaviconResolverInterface;
use App\ValueObjects\Url;
use Doctrine\ORM\EntityManagerInterface;

final readonly class UpdateBillHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private FaviconResolverInterface $faviconResolver,
    ) {
    }

    public function handle(Bill $bill, UpdateBill $data): void
    {
        $bill->setName($data->name);
        $bill->setInterval($data->interval);
        $bill->amount = $data->amount;

        if (null !== $data->url) {
            $url = Url::createFromString($data->url);
            $bill->url = $url;
            $bill->icon = $this->faviconResolver->resolve($url);
        } else {
            $bill->url = null;
            $bill->icon = null;
        }

        $this->entityManager->persist($bill);
        $this->entityManager->flush();
    }
}
