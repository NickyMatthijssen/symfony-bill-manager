<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Account;

use App\Domain\Entity\User;

final class DeleteAccount
{
    private bool $agreesToBeDeleted = false;

    public function __construct(
        private readonly User $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAgreesToBeDeleted(): bool
    {
        return $this->agreesToBeDeleted;
    }

    public function setAgreesToBeDeleted(bool $agreesToBeDeleted): void
    {
        $this->agreesToBeDeleted = $agreesToBeDeleted;
    }
}
