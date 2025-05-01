<?php

declare(strict_types=1);

namespace App\Presentation\Enum;

enum AlertType: string
{
    case Information = 'information';
    case Success = 'success';
    case Warning = 'warning';
    case Danger = 'danger';

    public function getBackgroundColor(): string
    {
        return match ($this) {
            self::Success => 'bg-green-50',
            self::Warning => 'bg-yellow-50',
            self::Danger => 'bg-red-50',
            self::Information => 'bg-blue-50',
        };
    }

    public function getTitleColor(): string
    {
        return match ($this) {
            self::Success => 'text-green-800',
            self::Warning => 'text-yellow-800',
            self::Danger => 'text-red-800',
            self::Information => 'text-blue-800',
        };
    }

    public function getMessageColor(): string
    {
        return match ($this) {
            self::Success => 'text-green-700',
            self::Warning => 'text-yellow-700',
            self::Danger => 'text-red-700',
            self::Information => 'text-blue-700',
        };
    }
}
