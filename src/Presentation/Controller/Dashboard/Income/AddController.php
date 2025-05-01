<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Income;

use App\Presentation\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route([
    'en' => '/dashboard/income/add',
    'nl' => '/dashboard/inkomen/toevoegen',
], name: 'dashboard.income.add')]
final class AddController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('dashboard/income/add.html.twig', []);
    }
}
