<?php

declare(strict_types=1);

namespace App\Enum;

enum AlertType: string
{
    case Information = 'information';
    case Success = 'success';
    case Warning = 'warning';
    case Danger = 'danger';
}
