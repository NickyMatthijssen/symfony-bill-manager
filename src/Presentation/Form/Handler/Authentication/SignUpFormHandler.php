<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Authentication;

use App\Application\Authentication\SignUp\SignUpCommand;
use App\Application\Common\AvatarGeneratorInterface;
use App\Application\Cqrs\CommandBusInterface;
use App\Domain\Entity\User;
use App\Domain\Exception\UnexpectedValueException;
use App\Presentation\Form\Model\Authentication\SignUp;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

final readonly class SignUpFormHandler
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function handle(SignUp $data): void
    {
        $email = $data->getEmail();
        if (null === $email) {
            throw UnexpectedValueException::unexpectedPropertyValue('email', $email);
        }

        $firstName = $data->getFirstName();
        if (null === $firstName) {
            throw UnexpectedValueException::unexpectedPropertyValue('firstName', $firstName);
        }

        $lastName = $data->getLastName();
        if (null === $lastName) {
            throw UnexpectedValueException::unexpectedPropertyValue('lastName', $lastName);
        }

        $plainPassword = $data->getPassword();
        if (null === $plainPassword) {
            throw UnexpectedValueException::unexpectedPropertyValue('plainPassword', $plainPassword);
        }

        $this->commandBus->send(new SignUpCommand(
            $email,
            $firstName,
            $lastName,
            $plainPassword,
        ));
    }
}
