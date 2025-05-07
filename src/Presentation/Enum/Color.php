<?php

declare(strict_types=1);

namespace App\Presentation\Enum;

enum Color: string
{
    case Red = 'red';
    case Green = 'green';
    case Yellow = 'yellow';
    case White = 'white';

    public function getTextColor(): string
    {
        return match ($this) {
            self::Red => 'text-red-200',
            self::Green => 'text-green-200',
            self::Yellow => 'text-yellow-200',
            self::White => 'text-white',
        };
    }
}
