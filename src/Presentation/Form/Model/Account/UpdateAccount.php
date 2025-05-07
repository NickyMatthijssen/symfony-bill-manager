<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Account;

use App\Domain\Entity\User;

final class UpdateAccount
{
    public function __construct(
        private readonly string $userIdentifier,
        private string $email,
        private string $firstName,
        private string $lastName,
    ) {
    }

    public function getUserIdentifier(): string
    {
        return $this->userIdentifier;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public static function createFromUser(User $user): self
    {
        return new self(
            $user->getUserIdentifier(),
            $user->getEmail(),
            $user->getFirstName(),
            $user->getLastName(),
        );
    }
}
