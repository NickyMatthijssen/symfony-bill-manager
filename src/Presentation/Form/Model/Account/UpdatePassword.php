<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Account;

final class UpdatePassword
{
    private ?string $currentPassword = null;
    private ?string $newPassword = null;

    public function getCurrentPassword(): ?string
    {
        return $this->currentPassword;
    }

    public function setCurrentPassword(?string $currentPassword): void
    {
        $this->currentPassword = $currentPassword;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(?string $newPassword): void
    {
        $this->newPassword = $newPassword;
    }
}
