<?php

declare(strict_types=1);

namespace App\Presentation\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class CardHeader
{
    public string $title;
}
