<?php

declare(strict_types=1);

namespace App\Application\Transaction\Command\UpdateTransaction;

use App\Application\Common\AvatarGeneratorInterface;
use App\Application\Common\FaviconResolverInterface;
use App\Domain\Entity\Transaction;
use App\Domain\Repository\TransactionRepositoryInterface;
use App\Domain\ValueObject\Url;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(handles: UpdateTransactionCommand::class)]
final readonly class UpdateTransactionCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private FaviconResolverInterface $faviconResolver,
        private AvatarGeneratorInterface $avatarGenerator,
        private TransactionRepositoryInterface $transactionRepository,
    ) {
    }

    public function __invoke(UpdateTransactionCommand $command): void
    {
        $transaction = $this->transactionRepository->findById($command->transactionId);

        $transaction->setName($command->name);
        $transaction->setInterval($command->interval);
        $transaction->setAmount($command->amount);
        $this->updateIcon($transaction, $command);

        $this->entityManager->flush();
    }

    private function updateIcon(Transaction $transaction, UpdateTransactionCommand $command): void
    {
        if ($transaction->getUrl()?->value === $command->url) {
            return;
        }

        $url = null !== $command->url ? Url::createFromString($command->url) : null;
        $transaction->setUrl($url);
        $transaction->setIcon(
            $url !== null
                ? $this->faviconResolver->resolve($url)
                : $this->avatarGenerator->generate($command->name),
        );
    }
}
