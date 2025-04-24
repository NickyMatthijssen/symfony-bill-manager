<?php

declare(strict_types=1);

namespace App\Twig\Components;

use App\Enum\AlertType;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Alert
{
    public AlertType $type {
        get => $this->type;
    }

    public string $title {
        get => $this->title;
    }

    public ?string $message = null {
        get => $this->message;
    }
}
