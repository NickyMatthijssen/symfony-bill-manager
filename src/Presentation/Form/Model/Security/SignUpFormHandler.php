<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Security;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Security\SignUp\SignUpCommand;
use App\Domain\Exception\UnexpectedValueException;
use App\Presentation\Form\Model\Authentication\SignUp;

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
