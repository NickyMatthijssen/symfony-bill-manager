<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Account;

use App\Domain\Entity\User;

final class UpdateAccount
{
    public function __construct(
        public User $user {
        get => $this->user;
        },
        public string $email {
        get => $this->email;
        set => $value;
        },
        public string $firstName {
        get => $this->firstName;
        set => $value;
        },
        public string $lastName {
        get => $this->lastName;
        set => $value;
        },
    ) {
    }

    public static function createFromUser(User $user): self
    {
        return new self(
            $user,
            $user->getEmail(),
            $user->getFirstName(),
            $user->getLastName(),
        );
    }
}
