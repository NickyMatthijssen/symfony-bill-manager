<?php

declare(strict_types=1);

namespace App\Form\Handler\Account;

use App\Form\Model\Account\UpdateAccount;
use Doctrine\ORM\EntityManagerInterface;

final readonly class UpdateAccountFormHandler
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(UpdateAccount $data): void
    {
        $user = $data->user;
        $user->setEmail($data->email);
        $user->firstName = $data->firstName;
        $user->lastName = $data->lastName;

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
