<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[IsGranted('IS_AUTHENTICATED_FULLY')]
class CoverLetterController extends AbstractController
{
    #[Route('/cover-letter/{id}', name: 'app_cover_letter', methods:['GET'])]
    public function show(): Response
    {
        return $this->render('cover_letter/show.html.twig', [
            'controller_name' => 'CoverLetterController',
        ]);
    }
    
    #[Route('/cover-letter/generate', name: 'app_cover_letter', methods:['POST'])]
    public function generate(): Response
    {
            // API call to generate cover letter
    }
}
