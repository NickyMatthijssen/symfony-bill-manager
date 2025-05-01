<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Money;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Income
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'money', nullable: false)]
    private Money $amount;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'incomes')]
    private User $user;

    public function __construct(User $user, string $name, Money $amount)
    {
        $this->user = $user;
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function setAmount(Money $amount): void
    {
        $this->amount = $amount;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
