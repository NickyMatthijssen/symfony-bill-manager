<?php

declare(strict_types=1);

namespace App\Form\Model\Authentication;

final class SignUp
{
    public string $email {
        get => $this->email;
        set => $value;
    }

    public string $password {
        get => $this->password;
        set => $value;
    }

    public string $firstName {
        get => $this->firstName;
        set => $value;
    }

    public string $lastName {
        get => $this->lastName;
        set => $value;
    }
}
