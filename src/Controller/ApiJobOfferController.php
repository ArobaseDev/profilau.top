<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[IsGranted('IS_AUTHENTICATED_FULLY')]
class ApiJobOfferController extends AbstractController
{
    #[Route('/api/job/offer', name: 'app_api_job_offer', methods:['POST'])]
    public function index(): Response
    {
        
        return $this->render('api_job_offer/index.html.twig', [
            'controller_name' => 'ApiJobOfferController',
        ]);
    }
}
