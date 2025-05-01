<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Presentation\Data\Alert;
use App\Presentation\Enum\AlertType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    protected function addAlert(AlertType $type, string $title, ?string $message = null): void
    {
        $this->addFlash('alerts', new Alert(
            $type,
            $title,
            $message,
        ));
    }

    protected function addInformationAlert(string $title, ?string $message = null): void
    {
        $this->addAlert(AlertType::Information, $title, $message);
    }

    protected function addSuccessAlert(string $title, ?string $message = null): void
    {
        $this->addAlert(AlertType::Success, $title, $message);
    }
}
