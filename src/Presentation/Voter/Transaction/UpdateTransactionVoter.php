<?php

declare(strict_types=1);

namespace App\Presentation\Voter\Transaction;

use App\Domain\Entity\Transaction;

final class UpdateTransactionVoter extends AbstractTransactionVoter
{
    public const string SUPPORTED_ATTRIBUTE = 'EDIT';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $attribute === self::SUPPORTED_ATTRIBUTE && $subject instanceof Transaction;
    }
}
