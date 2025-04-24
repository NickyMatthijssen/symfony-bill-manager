<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Interval;
use App\Repository\BillRepository;
use App\ValueObjects\Money;
use App\ValueObjects\Url;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillRepository::class)]
class Bill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null {
        get {
            return $this->id;
        }
    }

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'money', nullable: false)]
    public Money $amount {
        get => $this->amount;
        set => $value;
    }

    #[ORM\Column(type: 'string', length: 255, enumType: Interval::class)]
    private Interval $interval;

    #[ORM\Column(type: 'url', length: 255, nullable: true)]
    public ?Url $url {
        get => $this->url;
        set => $value;
    }

    #[ORM\Column(type: 'text', length: 4096, nullable: true)]
    public ?string $icon {
        get => $this->icon;
        set => $value;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bills')]
    public User $user {
        get => $this->user;
    }

    public function __construct(User $user, string $name, Money $amount, Interval $interval)
    {
        $this->user = $user;
        $this->name = $name;
        $this->amount = $amount;
        $this->interval = $interval;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getInterval(): Interval
    {
        return $this->interval;
    }

    public function setInterval(Interval $interval): void
    {
        $this->interval = $interval;
    }
}
