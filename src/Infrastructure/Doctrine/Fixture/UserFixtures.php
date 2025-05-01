<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Fixture;

use App\Domain\Entity\User;
use App\Domain\ValueObject\Base64;
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
        $user = new User(
            'user@example.com',
            'John',
            'Doe',
            Base64::createFromBase64('image/svg+xml', 'PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMT'),
        );
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));

        $manager->persist($user);
        $manager->flush();
    }
}
