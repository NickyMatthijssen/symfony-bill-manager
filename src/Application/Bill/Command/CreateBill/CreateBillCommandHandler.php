<?php

declare(strict_types=1);

namespace App\Application\Bill\Command\CreateBill;

use App\Application\Common\FaviconResolverInterface;
use App\Domain\Entity\Bill;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(handles: CreateBillCommand::class)]
final readonly class CreateBillCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private FaviconResolverInterface $faviconResolver,
    ) {
    }

    public function __invoke(CreateBillCommand $command): Bill
    {
        $bill = new Bill(
            $command->user,
            $command->name,
            $command->amount,
            $command->interval,
        );

        $url = $command->url;
        if (null !== $url) {
            $bill->setUrl($url);
            $bill->setIcon(
                $this->faviconResolver->resolve($url),
            );
        }

        $this->entityManager->persist($bill);
        $this->entityManager->flush();

        return $bill;
    }
}
