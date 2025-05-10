<?php

declare(strict_types=1);

use App\Application\Common\AvatarGeneratorInterface;
use App\Application\Common\FaviconResolverInterface;
use App\Application\Transaction\Command\CreateTransaction\CreateTransactionCommand;
use App\Application\Transaction\Command\CreateTransaction\CreateTransactionCommandHandler;
use App\Domain\Entity\Transaction;
use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Base64;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Url;
use App\Tests\Mock\Domain\Entity\UserMock;
use Doctrine\ORM\EntityManagerInterface;

it('is possible to create a transaction', function (?Url $url): void {
    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('flush');

    $faviconResolver = $this->createMock(FaviconResolverInterface::class);
    $avatarGenerator = $this->createMock(AvatarGeneratorInterface::class);

    if (null === $url) {
        $expectedIcon = Base64::createFromContent('avatar', 'content');

        $avatarGenerator->expects($this->once())->method('generate')->willReturn($expectedIcon);
        $faviconResolver->expects($this->never())->method('resolve');
    } else {
        $expectedIcon = Base64::createFromContent('favicon', 'content');

        $faviconResolver->expects($this->once())->method('resolve')->willReturn($expectedIcon);
        $avatarGenerator->expects($this->never())->method('generate');
    }

    $user = UserMock::create();
    $userRepository = $this->createMock(UserRepositoryInterface::class);
    $userRepository->expects($this->once())->method('findByUserIdentifier')->with('the_user')->willReturn($user);

    $handler = new CreateTransactionCommandHandler(
        $entityManager,
        $faviconResolver,
        $avatarGenerator,
        $userRepository,
    );
    $createdTransaction = $handler(
        new CreateTransactionCommand(
            'the_user',
            'transaction name',
            Money::createFromCents(250),
            Interval::Monthly,
            TransactionType::Expense,
            $url,
        ),
    );

    $expectedTransaction = new Transaction(
        $user,
        'transaction name',
        Money::createFromCents(250),
        Interval::Monthly,
        TransactionType::Expense,
    );
    $expectedTransaction->setUrl($url);
    $expectedTransaction->setIcon($expectedIcon);

    expect($createdTransaction)->toEqual($expectedTransaction);
})->with([
    'with a url' => [Url::createFromString('https://url.test')],
    'without a url' => [null],
]);
