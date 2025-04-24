<?php

declare(strict_types=1);

namespace App\Form\Handler\Account;

use App\Entity\User;
use App\Form\Model\Account\DeleteAccount;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\SecurityBundle\Security;
use UnexpectedValueException;

final readonly class DeleteAccountFormHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Security $security,
    ) {
    }

    public function handle(DeleteAccount $data): void
    {
        if (!$data->agreesToBeDeleted) {
            throw new UnexpectedValueException('A user needs to agree to be deleted.');
        }

        if (!$this->isToBeDeletedUserSignedIn($data->user)) {
            throw new LogicException('Only a signed in user can delete their own account.');
        }

        $this->entityManager->remove($data->user);
        $this->entityManager->flush();

        $this->security->logout(false);
    }

    private function isToBeDeletedUserSignedIn(User $user): bool
    {
        $signedInUser = $this->security->getUser();
        if (null === $signedInUser) {
            return false;
        }

        if (!($signedInUser instanceof User)) {
            throw new UnexpectedValueException(sprintf(
                'signedInUser is not a User but type of %s',
                get_debug_type($signedInUser),
            ));
        }

        return $user->getId() === $signedInUser->getId();
    }
}
