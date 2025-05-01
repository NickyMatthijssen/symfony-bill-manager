<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Account;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Security\UpdatePassword\UpdatePasswordCommand;
use App\Domain\Entity\User;
use App\Presentation\Form\Model\Account\UpdatePassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Domain\Exception\UnexpectedValueException;

final readonly class UpdatePasswordHandler
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private Security $security,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function handle(UpdatePassword $data): void
    {
        $user = $this->security->getUser();
        if (!($user instanceof User)) {
            throw UnexpectedValueException::unexpectedPropertyValue('user', $user);
        }

        if (!$this->passwordHasher->isPasswordValid($user, (string) $data->getCurrentPassword())) {
            throw new UnexpectedValueException('The current password is incorrect.');
        }

        $newPassword = $data->getNewPassword();
        if (null === $newPassword) {
            throw UnexpectedValueException::unexpectedPropertyValue('newPassword', $newPassword);
        }

        $this->commandBus->send(new UpdatePasswordCommand($user, $newPassword));
    }
}
