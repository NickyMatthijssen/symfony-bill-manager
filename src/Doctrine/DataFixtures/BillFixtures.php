<?php

declare(strict_types=1);

namespace App\Doctrine\DataFixtures;

use App\Entity\Bill;
use App\Enum\Interval;
use App\Repository\UserRepository;
use App\ValueObjects\Money;
use App\ValueObjects\Url;
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

        $bill = new Bill($user, 'Car Insurance', Money::createFromCents(22000), Interval::Monthly);
        $bill->url = Url::createFromString('http://example.com/');
        $manager->persist($bill);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}
