<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[IsGranted('IS_AUTHENTICATED_FULLY')]
class KanbanController extends AbstractController
{
    #[Route('/kanban', name: 'app_kanban', methods:['GET'])]
    public function index(): Response
    {
        return $this->render('kanban/index.html.twig', );
    }
}
