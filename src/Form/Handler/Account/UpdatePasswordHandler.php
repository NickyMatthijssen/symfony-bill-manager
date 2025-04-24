<?php

declare(strict_types=1);

namespace App\Form\Handler\Account;

use App\Form\Model\Account\UpdatePassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use UnexpectedValueException;

final readonly class UpdatePasswordHandler
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function handle(UpdatePassword $data): void
    {
        $user = $data->user;

        if (!$this->passwordHasher->isPasswordValid($user, $data->currentPassword)) {
            throw new UnexpectedValueException('The current password is incorrect.');
        }

        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $data->password),
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
