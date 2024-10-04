<?php

namespace App\Controller;

use Gemini;
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
    
    #[Route('/cover-letter/generate', name: 'app_cover_letter_generate', methods:['POST'])]
    public function generate(): Response
    {
        $apiKey = $this->getParameter('GEMINI_API_KEY');
        $client = Gemini::client($apiKey);
        $result = $client->geminiPro()->generateContent('Hello');
       dd($result->text());
            // API call to generate cover letter
    }
}
