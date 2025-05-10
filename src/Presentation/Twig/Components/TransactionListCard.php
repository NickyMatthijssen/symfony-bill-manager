<?php

declare(strict_types=1);

namespace App\Presentation\Twig\Components;

use App\Domain\Collections\TransactionCollection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class TransactionListCard
{
    private string $title;
    private TransactionCollection $transactions;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTransactions(): TransactionCollection
    {
        return $this->transactions;
    }

    public function setTransactions(TransactionCollection $transactions): void
    {
        $this->transactions = $transactions;
    }
}
