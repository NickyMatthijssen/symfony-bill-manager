<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Authentication;

use SensitiveParameter;

final class SignUp
{
    private ?string $email = null;
    private ?string $password = null;
    private ?string $firstName = null;
    private ?string $lastName = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(#[SensitiveParameter] ?string $password): void
    {
        $this->password = $password;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }
}
