<?php

declare(strict_types=1);

use App\Application\Common\AvatarGeneratorInterface;
use App\Application\Security\Command\SignUp\SignUpCommand;
use App\Application\Security\Command\SignUp\SignUpCommandHandler;
use App\Domain\ValueObject\Base64;
use App\Tests\Mock\Domain\Entity\UserMock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

it('can update password', function () {
    $user = UserMock::create();
    $user->setPassword('hashedPassword');

    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('persist')->with($user);
    $entityManager->expects($this->once())->method('flush');

    $userPasswordHasher = $this->createMock(UserPasswordHasherInterface::class);
    $userPasswordHasher->expects($this->once())->method('hashPassword')->with(UserMock::create(), 'password')->willReturn('hashedPassword');

    $avatarGenerator = $this->createStub(AvatarGeneratorInterface::class);
    $avatarGenerator->method('generate')->willReturn(new Base64('type', 'value'));

    $handler = new SignUpCommandHandler($entityManager, $userPasswordHasher, $avatarGenerator);
    $handler(
        new SignUpCommand(
            'user@example.com',
            'first',
            'last',
            'password',
        )
    );
});
