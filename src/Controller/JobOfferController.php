<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[IsGranted('IS_AUTHENTICATED_FULLY')]
class JobOfferController extends AbstractController
{
    #[Route('/job-offers', name: 'app_job_offer', methods: ['GET'])]
    public function list(): Response
    {
        return $this->render('job_offer/list.html.twig',);
    }
    
    #[Route('/job-offers/new', name: 'app_job_offer', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        return $this->render('job_offer/new.html.twig', );
    }
    #[Route('/job-offers/{id}', name: 'app_job_offer', methods: ['GET'])]
    public function show(): Response
    {
        return $this->render('job_offer/show.html.twig', );
    }
    #[Route('/job-offers/{}/edit', name: 'app_job_offer', methods: ['GET', 'POST'])]
    public function edit(): Response
    {
        return $this->render('job_offer/edit.html.twig', );
    }
    #[Route('/job-offers/{id}/delete', name: 'app_job_offer', methods: ['POST'])]
    public function delete(): Response
    {
        return $this->render('job_offer/new.html.twig', );
    }
}
