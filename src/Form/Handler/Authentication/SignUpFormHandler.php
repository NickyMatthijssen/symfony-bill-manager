<?php

declare(strict_types=1);

namespace App\Form\Handler\Authentication;

use App\Entity\User;
use App\Form\Model\Authentication\SignUp;
use App\Service\AvatarGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

final readonly class SignUpFormHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
        private AvatarGeneratorInterface $avatarGenerator,
    ) {
    }

    public function handle(SignUp $data): void
    {
        $user = new User();
        $user->setEmail($data->email);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $data->password));
        $user->firstName = $data->firstName;
        $user->lastName = $data->firstName;
        $user->avatar = $this->avatarGenerator->generate(Uuid::v4()->toString());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
