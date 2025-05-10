<?php

declare(strict_types=1);

use App\Domain\Entity\User;
use App\Domain\Exception\EntityNotFoundException;
use App\Infrastructure\Doctrine\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

uses(KernelTestCase::class);

test('find a user by their id', function () {
    $userRepository = $this->getContainer()->get(UserRepository::class);
    $user = $userRepository->findById(1);

    $this->assertInstanceOf(User::class, $user);
    $this->assertEquals(1, $user->getId());
});

test('throws an exception if user could not be found by id', function () {
    $this->expectException(EntityNotFoundException::class);
    $this->expectExceptionMessage('Could not find entity "App\Domain\Entity\User" with attribute "id" with value "100"');

    $userRepository = $this->getContainer()->get(UserRepository::class);
    $userRepository->findById(100);
});

test('find a user by their user identifier', function () {
    $userRepository = $this->getContainer()->get(UserRepository::class);
    $user = $userRepository->findByUserIdentifier('user@example.com');

    $this->assertInstanceOf(User::class, $user);
    $this->assertEquals('user@example.com', $user->getUserIdentifier());
});

test('throws an exception if user could not be found by their user identifier', function () {
    $this->expectException(EntityNotFoundException::class);
    $this->expectExceptionMessage('Could not find entity "App\Domain\Entity\User" with attribute "email" with value "doesnotexist@example.com"');

    $userRepository = $this->getContainer()->get(UserRepository::class);
    $userRepository->findByUserIdentifier('doesnotexist@example.com');
});
