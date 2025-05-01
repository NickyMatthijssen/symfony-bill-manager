<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Bill;

use App\Domain\Entity\User;
use App\Domain\Enum\Interval;
use App\Domain\ValueObject\Money;
use Symfony\Component\Validator\Constraints as Assert;

final class AddBill
{
    #[Assert\Length(min: 5, max: 255)]
    private ?string $name = null;

    #[Assert\NotBlank]
    private ?Money $amount = null;

    #[Assert\NotBlank]
    private ?Interval $interval = null;

    #[Assert\AtLeastOneOf([
        new Assert\Url(),
        new Assert\Blank(),
    ])]
    private ?string $url = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): ?Money
    {
        return $this->amount;
    }

    public function setAmount(?Money $amount): void
    {
        $this->amount = $amount;
    }

    public function getInterval(): ?Interval
    {
        return $this->interval;
    }

    public function setInterval(?Interval $interval): void
    {
        $this->interval = $interval;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
