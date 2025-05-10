<?php

declare(strict_types=1);

use App\Application\Common\AvatarGeneratorInterface;
use App\Application\Common\FaviconResolverInterface;
use App\Application\Transaction\Command\UpdateTransaction\UpdateTransactionCommand;
use App\Application\Transaction\Command\UpdateTransaction\UpdateTransactionCommandHandler;
use App\Domain\Enum\Interval;
use App\Domain\Repository\TransactionRepositoryInterface;
use App\Domain\ValueObject\Base64;
use App\Domain\ValueObject\Money;
use App\Tests\Mock\Domain\Entity\TransactionMock;
use Doctrine\ORM\EntityManagerInterface;

test('a transaction can be updated', function (?string $url) {
    $initialUrl = 'https://initialurl.com';
    $transaction = TransactionMock::create(url: $initialUrl);

    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('flush');

    $avatarGenerator = $this->createMock(AvatarGeneratorInterface::class);
    $faviconResolver = $this->createMock(FaviconResolverInterface::class);

    if ($initialUrl === $url) {
        $expectedIcon = null;

        $avatarGenerator->expects($this->never())->method('generate');
        $faviconResolver->expects($this->never())->method('resolve');
    } elseif (null === $url) {
        $expectedIcon = new Base64('avatar', 'content');

        $avatarGenerator->expects($this->once())->method('generate')->willReturn($expectedIcon);
        $faviconResolver->expects($this->never())->method('resolve');
    } else {
        $expectedIcon = new Base64('favicon', 'content');

        $faviconResolver->expects($this->once())->method('resolve')->willReturn($expectedIcon);
        $avatarGenerator->expects($this->never())->method('generate');
    }

    $transactionRepository = $this->createMock(TransactionRepositoryInterface::class);
    $transactionRepository->expects($this->once())->method('findById')
        ->with(1212)
        ->willReturn($transaction);

    $expectedTransaction = TransactionMock::create(
        name: 'updated name',
        amountInCents: 42069,
        interval: Interval::Yearly,
        url: $url,
        icon: $expectedIcon,
    );
    expect($transaction)->not->toEqual($expectedTransaction);

    $handler = new UpdateTransactionCommandHandler(
        $entityManager,
        $faviconResolver,
        $avatarGenerator,
        $transactionRepository,
    );
    $handler(
        new UpdateTransactionCommand(
            1212,
            'updated name',
            Money::createFromCents(42069),
            Interval::Yearly,
            $url,
        )
    );

    expect($transaction)->toEqual($expectedTransaction);
})->with([
    'with a null url' => [null],
    'with the initial url' => ['https://initialurl.com'],
    'with a new url' => ['https://newurl.com'],
]);
