<?php

declare(strict_types=1);

namespace App\Presentation\Twig\Components;

use App\Presentation\Enum\AlertType;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Alert
{
    public AlertType $type;
    public string $title;
    public ?string $message;
}
