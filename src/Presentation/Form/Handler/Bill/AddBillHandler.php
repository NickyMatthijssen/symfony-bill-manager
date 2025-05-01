<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Bill;

use App\Application\Bill\Command\CreateBill\CreateBillCommand;
use App\Application\Cqrs\CommandBusInterface;
use App\Domain\Entity\Bill;
use App\Domain\Entity\User;
use App\Domain\Exception\UnexpectedValueException;
use App\Domain\ValueObject\Url;
use App\Presentation\Form\Model\Bill\AddBill;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class AddBillHandler
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private Security $security,
    ) {
    }

    public function handle(AddBill $data): Bill
    {
        $user = $this->security->getUser();
        if (!($user instanceof User)) {
            throw UnexpectedValueException::unexpectedPropertyValue('user', $user);
        }

        $name = $data->getName();
        if (null === $name) {
            throw new UnexpectedValueException('property "name" should not be null at this point.');
        }

        $interval = $data->getInterval();
        if (null === $interval) {
            throw new UnexpectedValueException('property "interval" should not be null at this point.');
        }

        $amount = $data->getAmount();
        if (null === $amount) {
            throw UnexpectedValueException::unexpectedPropertyValue('amount', $amount);
        }

        $urlValue = $data->getUrl();
        $url = null === $urlValue ? null : Url::createFromString($urlValue);

        return $this->commandBus->send(new CreateBillCommand(
            $user,
            $name,
            $amount,
            $interval,
            $url,
        ));
    }
}
