<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Fixture;

use App\Domain\Entity\Bill;
use App\Domain\Entity\User;
use App\Domain\Enum\Interval;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Url;
use App\Infrastructure\Doctrine\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class BillFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = $this->userRepository->findOneBy([
            'email' => 'user@example.com',
        ]);
        assert($user instanceof User);

        $bill = new Bill($user, 'Car Insurance', Money::createFromCents(22000), Interval::Monthly);
        $bill->setUrl(Url::createFromString('http://example.com/'));
        $manager->persist($bill);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}
