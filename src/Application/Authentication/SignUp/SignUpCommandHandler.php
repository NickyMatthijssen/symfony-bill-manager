<?php

declare(strict_types=1);

namespace App\Application\Authentication\SignUp;

use App\Application\Common\AvatarGeneratorInterface;
use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler(handles: SignUpCommand::class)]
final readonly class SignUpCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
        private AvatarGeneratorInterface $avatarGenerator,
    ) {
    }

    public function __invoke(SignUpCommand $command): void
    {
        $user = new User(
            $command->email,
            $command->firstName,
            $command->lastName,
            $this->avatarGenerator->generate(Uuid::v4()->toString()),
        );
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $command->password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
