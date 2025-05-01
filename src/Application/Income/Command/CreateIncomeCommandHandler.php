<?php

declare(strict_types=1);

namespace App\Application\Income\Command;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CreateIncomeCommandHandler
{
    public function __invoke(CreateIncomeCommand $command): void
    {
        
        // TODO: Implement __invoke() method.
    }
}
