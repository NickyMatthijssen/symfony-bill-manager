<?php

declare(strict_types=1);

namespace App\Form\Model\Bill;

use App\Entity\User;
use App\Enum\Interval;
use App\ValueObjects\Money;
use Symfony\Component\Validator\Constraints as Assert;

final class AddBill
{
    #[Assert\Length(min: 5, max: 255)]
    public ?string $name = null {
        get => $this->name;
        set => $value;
    }

    #[Assert\NotBlank]
    public Money $amount {
        get => $this->amount;
        set => $value;
    }

    #[Assert\NotBlank]
    public ?Interval $interval = null {
        get => $this->interval;
        set => $value;
    }

    #[Assert\AtLeastOneOf([
        new Assert\Url(),
        new Assert\Blank(),
    ])]
    public ?string $url = null {
        get => $this->url;
        set => $value;
    }

    public User $user {
        get => $this->user;
    }

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
