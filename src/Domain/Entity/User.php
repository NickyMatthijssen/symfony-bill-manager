<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Base64;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use LengthException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, nullable: false)]
    private string $email;

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100, nullable: false)]
    private string $firstName;

    #[ORM\Column(length: 100, nullable: false)]
    private string $lastName;

    #[ORM\Column(type: 'base64', length: 4096, nullable: false)]
    private Base64 $avatar;

    /**
     * @var Collection<array-key, Bill>
     */
    #[ORM\OneToMany(targetEntity: Bill::class, mappedBy: 'user', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $bills;

    /**
     * @var Collection<array-key, Income>
     */
    #[ORM\OneToMany(targetEntity: Income::class, mappedBy: 'user', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $incomes;

    public function __construct(
        string $email,
        string $firstName,
        string $lastName,
        Base64 $avatar,
    ) {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->avatar = $avatar;
        $this->bills = new ArrayCollection();
        $this->incomes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    public function getAvatar(): Base64
    {
        return $this->avatar;
    }

    public function setAvatar(Base64 $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getUserIdentifier(): string
    {
        if (0 === strlen($this->email)) {
            throw new LengthException('User email should not be empty.');
        }

        return $this->email;
    }

    /**
     * @return list<string>
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // noop
    }

    /**
     * @return Collection<array-key, Bill>
     */
    public function getBills(): Collection
    {
        return $this->bills;
    }

    /**
     * @return Collection<array-key, Income>
     */
    public function getIncomes(): Collection
    {
        return $this->incomes;
    }
}
