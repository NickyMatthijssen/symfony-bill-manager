<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Income
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public ?int $id = null {
        get => $this->id;
    }

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    public string $name {
        get => $this->name;
        set => $value;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'incomes')]
    public User $user {
        get => $this->user;
        set => $value;
    }

    public function __construct(User $user, string $name)
    {
        $this->user = $user;
        $this->name = $name;
    }
}
