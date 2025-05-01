<?php

declare(strict_types=1);

use App\Application\Authentication\SignUp\SignUpCommand;
use App\Application\Authentication\SignUp\SignUpCommandHandler;
use App\Application\Common\AvatarGeneratorInterface;
use App\Domain\Entity\User;
use App\Domain\ValueObject\Base64;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

it('can update password', function () {
    $user = createUser();
    $user->setPassword('hashedPassword');

    $entityManager = $this->createMock(EntityManagerInterface::class);
    $entityManager->expects($this->once())->method('persist')->with($user);
    $entityManager->expects($this->once())->method('flush');

    $userPasswordHasher = $this->createMock(UserPasswordHasherInterface::class);
    $userPasswordHasher->expects($this->once())->method('hashPassword')->with(createUser(), 'password')->willReturn('hashedPassword');

    $avatarGenerator = $this->createStub(AvatarGeneratorInterface::class);
    $avatarGenerator->method('generate')->willReturn(new Base64('type', 'value'));

    $handler = new SignUpCommandHandler(
        $entityManager,
        $userPasswordHasher,
        $avatarGenerator,
    );

    $handler(new SignUpCommand(
        'user@example.com',
        'first',
        'last',
        'password',
    ));
});

function createUser(): User
{
    return new User('user@example.com', 'first', 'last', new Base64('type', 'value'));
}