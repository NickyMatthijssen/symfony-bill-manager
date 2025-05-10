<?php

declare(strict_types=1);

use App\Application\Security\Command\UpdatePassword\UpdatePasswordCommand;
use App\Application\Security\Command\UpdatePassword\UpdatePasswordCommandHandler;
use App\Domain\Repository\UserRepositoryInterface;
use App\Tests\Mock\Domain\Entity\UserMock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

test('a user password is updated', function () {
    $user = UserMock::create();

    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('flush');

    $userPasswordHasher = $this->createMock(UserPasswordHasherInterface::class);
    $userPasswordHasher->expects($this->once())->method('hashPassword')
        ->with($user, 'my_new_password')
        ->willReturn('my_new_hashed_password');

    $userRepository = $this->createMock(UserRepositoryInterface::class);
    $userRepository->expects($this->once())->method('findByUserIdentifier')
        ->with('the_user')
        ->willReturn($user);

    expect($user->getPassword())->not->toBe('my_new_hashed_password');

    $handler = new UpdatePasswordCommandHandler($entityManager, $userPasswordHasher, $userRepository);
    $handler(
        new UpdatePasswordCommand(
            'the_user',
            'my_new_password',
        ),
    );

    expect($user->getPassword())->toBe('my_new_hashed_password');
});
