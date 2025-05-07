<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\ValueObject\Base64;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Url;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'transaction')]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'money', nullable: false)]
    private Money $amount;

    #[ORM\Column(type: 'string', length: 255, enumType: Interval::class)]
    private Interval $interval;

    #[ORM\Column(type: 'url', length: 255, nullable: true)]
    private ?Url $url;

    #[ORM\Column(type: 'base64', length: 4096, nullable: true)]
    private ?Base64 $icon;

    #[ORM\Column(type: 'string', enumType: TransactionType::class)]
    private TransactionType $type;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bills')]
    private User $user;

    public function __construct(User $user, string $name, Money $amount, Interval $interval, TransactionType $type)
    {
        $this->user = $user;
        $this->name = $name;
        $this->amount = $amount;
        $this->interval = $interval;
        $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function setAmount(Money $amount): void
    {
        $this->amount = $amount;
    }

    public function getInterval(): Interval
    {
        return $this->interval;
    }

    public function setInterval(Interval $interval): void
    {
        $this->interval = $interval;
    }

    public function getType(): TransactionType
    {
        return $this->type;
    }

    public function getIcon(): ?Base64
    {
        return $this->icon;
    }

    public function setIcon(?Base64 $icon): void
    {
        $this->icon = $icon;
    }

    public function getUrl(): ?Url
    {
        return $this->url;
    }

    public function setUrl(?Url $url): void
    {
        $this->url = $url;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
