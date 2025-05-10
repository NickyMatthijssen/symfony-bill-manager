<?php

declare(strict_types=1);

use App\Application\Security\Command\UpdateUser\UpdateUserCommand;
use App\Application\Security\Command\UpdateUser\UpdateUserCommandHandler;
use App\Domain\Repository\UserRepositoryInterface;
use App\Tests\Mock\Domain\Entity\UserMock;
use Doctrine\ORM\EntityManagerInterface;

test('the user information is updated', function () {
    $user = UserMock::create(
        'old_email@test.com',
        'old first name',
        'old last name',
    );

    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('flush');

    $userRepository = $this->createMock(UserRepositoryInterface::class);
    $userRepository->expects($this->once())->method('findByUserIdentifier')
        ->with('the_user')
        ->willReturn($user);

    expect($user->getEmail())->toBe('old_email@test.com')
        ->and($user->getFirstName())->toBe('old first name')
        ->and($user->getLastName())->toBe('old last name');

    $handler = new UpdateUserCommandHandler($userRepository, $entityManager);
    $handler(
        new UpdateUserCommand(
            'the_user',
            'the_new_email@test.com',
            'new first name',
            'new last name',
        ),
    );

    expect($user->getEmail())->toBe('the_new_email@test.com')
        ->and($user->getFirstName())->toBe('new first name')
        ->and($user->getLastName())->toBe('new last name');
});
