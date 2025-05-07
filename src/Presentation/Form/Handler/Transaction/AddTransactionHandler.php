<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Transaction;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Transaction\Command\CreateTransaction\CreateTransactionCommand;
use App\Domain\Entity\Transaction;
use App\Domain\Entity\User;
use App\Domain\Exception\UnexpectedValueException;
use App\Domain\ValueObject\Url;
use App\Presentation\Form\Model\Transaction\AddTransaction;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class AddTransactionHandler
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private Security $security,
    ) {
    }

    public function handle(AddTransaction $data): Transaction
    {
        $user = $this->security->getUser();
        if (!($user instanceof User)) {
            throw UnexpectedValueException::unexpectedPropertyValue('user', $user);
        }

        $name = $data->getName();
        if (null === $name) {
            throw UnexpectedValueException::unexpectedPropertyValue('name', $name);
        }

        $interval = $data->getInterval();
        if (null === $interval) {
            throw UnexpectedValueException::unexpectedPropertyValue('interval', $interval);
        }

        $type = $data->getType();
        if (null === $type) {
            throw UnexpectedValueException::unexpectedPropertyValue('type', $type);
        }

        $amount = $data->getAmount();
        if (null === $amount) {
            throw UnexpectedValueException::unexpectedPropertyValue('amount', $amount);
        }

        $urlValue = $data->getUrl();
        $url = null === $urlValue ? null : Url::createFromString($urlValue);

        return $this->commandBus->send(new CreateTransactionCommand(
            $user->getUserIdentifier(),
            $name,
            $amount,
            $interval,
            $type,
            $url,
        ));
    }
}
