<?php

declare(strict_types=1);

namespace App\Presentation\Voter\Transaction;

use App\Domain\Entity\Transaction;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @extends Voter<string, Transaction>
 */
abstract class AbstractTransactionVoter extends Voter
{
    final protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        if (!$this->supports($attribute, $subject)) {
            throw new LogicException('Voting should not happen if the voter is not supported.');
        }

        return $token->getUser()?->getUserIdentifier() === $subject->getUser()->getUserIdentifier();
    }
}
