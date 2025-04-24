<?php

declare(strict_types=1);

namespace App\Form\Model\Account;

use App\Entity\User;

final class DeleteAccount
{
    public bool $agreesToBeDeleted = false {
        get => $this->agreesToBeDeleted;
        set => $value;
    }

    public function __construct(
        public User $user {
        get => $this->user;
        },
    ) {
    }
}
