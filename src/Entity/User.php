<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use App\ValueObjects\Base64;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100, nullable: false)]
    public string $firstName {
        get => $this->firstName;
        set => $value;
    }

    #[ORM\Column(length: 100, nullable: false)]
    public string $lastName {
        get => $this->lastName;
        set => $value;
    }

    #[ORM\Column(type: 'base64', length: 4096, nullable: false)]
    public Base64 $avatar {
        get => $this->avatar;
        set => $value;
    }

    public string $fullName {
        get => sprintf('%s %s', $this->firstName, $this->lastName);
    }

    #[ORM\OneToMany(targetEntity: Bill::class, mappedBy: 'user', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $bills;

    #[ORM\OneToMany(targetEntity: Income::class, mappedBy: 'user', cascade: ['persist', 'remove'], orphanRemoval: true)]
    public Collection $incomes {
        get => $this->incomes;
        set => $value;
    }

    public function __construct()
    {
        $this->bills = new ArrayCollection();
        $this->incomes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<array-key, Bill>
     */
    public function getBills(): Collection
    {
        return $this->bills;
    }
}
