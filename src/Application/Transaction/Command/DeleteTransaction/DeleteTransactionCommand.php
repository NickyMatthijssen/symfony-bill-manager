<?php

declare(strict_types=1);

namespace App\Application\Transaction\Command\DeleteTransaction;

use App\Application\Cqrs\CommandInterface;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<void>
 */
#[AsMessage]
final readonly class DeleteTransactionCommand implements CommandInterface
{
    public function __construct(public int $transactionId)
    {
    }
}
