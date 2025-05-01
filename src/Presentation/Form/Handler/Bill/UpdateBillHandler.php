<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Bill;

use App\Application\Common\FaviconResolverInterface;
use App\Domain\Entity\Bill;
use App\Domain\ValueObject\Url;
use App\Presentation\Form\Model\Bill\UpdateBill;
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
        $bill->setAmount($data->amount);

        if (null !== $data->url) {
            $url = Url::createFromString($data->url);
            $bill->setUrl($url);
            $bill->setIcon($this->faviconResolver->resolve($url));
        } else {
            $bill->setUrl(null);
            $bill->setIcon(null);
        }

        $this->entityManager->persist($bill);
        $this->entityManager->flush();
    }
}
