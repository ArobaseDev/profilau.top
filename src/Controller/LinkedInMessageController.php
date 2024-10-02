<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
class LinkedInMessageController extends AbstractController
{
    #[Route('/linkedin-message/generate', name: 'app_linked_in_message', methods: "POST")]
    public function generate(): Response
    {
        return $this->render('linked_in_message/index.html.twig', );
    }
    
    #[Route('/linkedin-message/{id}', name: 'app_linked_in_message', methods:["GET"])]
    public function show(): Response
    {
        return $this->render('linkedin_message/show.html.twig', );
    }
}
