<?php

declare(strict_types=1);

use App\Application\Security\Command\DeleteUser\DeleteUserCommand;
use App\Application\Security\Command\DeleteUser\DeleteUserCommandHandler;
use App\Domain\Repository\UserRepositoryInterface;
use App\Tests\Mock\Domain\Entity\UserMock;
use Doctrine\ORM\EntityManagerInterface;

it('can delete user', function () {
    $user = UserMock::create();
    $user->setPassword('hashedPassword');

    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('remove')->with($user);
    $entityManager->expects($this->once())->method('flush');

    $userRepository = $this->createMock(UserRepositoryInterface::class);
    $userRepository->expects($this->once())->method('findByUserIdentifier')->with('some_identifier')->willReturn($user);

    $handler = new DeleteUserCommandHandler($userRepository, $entityManager);
    $handler(
        new DeleteUserCommand('some_identifier'),
    );
});
