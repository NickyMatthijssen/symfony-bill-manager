<?php

declare(strict_types=1);

namespace App\Form\Handler\Bill;

use App\Builder\BillBuilder;
use App\Entity\Bill;
use App\Form\Model\Bill\AddBill;
use App\Service\FaviconResolverInterface;
use App\ValueObjects\Url;
use Doctrine\ORM\EntityManagerInterface;
use UnexpectedValueException;

final readonly class AddBillHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private FaviconResolverInterface $faviconResolver,
    ) {
    }

    public function handle(AddBill $data): Bill
    {
        $name = $data->name;
        if (null === $name) {
            throw new UnexpectedValueException('property "name" should not be null at this point.');
        }

        $interval = $data->interval;
        if (null === $interval) {
            throw new UnexpectedValueException('property "interval" should not be null at this point.');
        }

        $billBuilder = new BillBuilder(
            $data->user,
            $data->name,
            $data->amount,
            $data->interval,
        );

        if (null !== $data->url) {
            $url = Url::createFromString($data->url);
            $billBuilder->setUrl($url);
            $billBuilder->setIcon($this->faviconResolver->resolve($url));
        }

        $bill = $billBuilder->build();
        $this->entityManager->persist($bill);
        $this->entityManager->flush();

        return $bill;
    }
}
