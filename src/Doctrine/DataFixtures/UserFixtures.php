<?php

declare(strict_types=1);

namespace App\Doctrine\DataFixtures;

use App\Entity\User;
use App\ValueObjects\Base64;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
        $user->firstName = 'John';
        $user->lastName = 'Doe';
        $user->avatar = Base64::createFromBase64('image/svg+xml', 'PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnL3N2ZyI+PGNpcmNsZSBjeD0iOCIgY3k9IjgiIHI9IjUiIGZpbGw9InJlZCIgLz48L3N2Zz4');
        $manager->persist($user);

        $manager->flush();
    }
}
