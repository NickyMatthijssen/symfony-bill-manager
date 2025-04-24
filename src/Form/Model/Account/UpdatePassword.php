<?php

declare(strict_types=1);

namespace App\Form\Model\Account;

use App\Entity\User;

final class UpdatePassword
{
    public string $currentPassword {
        get => $this->currentPassword;
        set => $value;
    }

    public string $password {
        get => $this->password;
        set => $value;
    }

    public function __construct(public readonly User $user)
    {
    }
}
