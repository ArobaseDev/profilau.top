<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Form\JobFormType;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[IsGranted('IS_AUTHENTICATED_FULLY')]
class JobOfferController extends AbstractController
{
    #[Route('/job-offers', name: 'app_job_offer', methods: ['GET'])]
    public function list(JobOfferRepository $jr): Response
    {
        $offers = $jr->findAll();
        dd($offers);
        return $this->render('job_offer/list.html.twig',);
    }
    
    #[Route('/job-offers/new', name: 'app_job_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        $job = new JobOffer;
        $form = $this->createForm(JobFormType::class, $job); // Chargement du formulaire
        $form->handleRequest($request); // Traitement du formulaire
        
        if ($form->isSubmitted() && $form->isValid()) {
        // Ajout de l'utilisateur connecté à l'offre
            $job->setAppUser($this->getUser());
            // Enregistrement de l'offre dans la base de données
            $em->persist($job);
            $em->flush();
            
            return $this->redirectToRoute('app_job_offer', [
                'id' => $job->getId(),
            ]);
        }
        return $this->render('job_offer/new.html.twig', [
            'jobForm' => $form->createView(),
        ]);
    }
    
    #[Route('/job-offers/{id}', name: 'app_job_offer_show', methods: ['GET'])]
    public function show(): Response
    {
        return $this->render('job_offer/show.html.twig', );
    }
    
    #[Route('/job-offers/{id}/edit', name: 'app_job_offer_edit', methods: ['GET', 'POST'])]
    public function edit(): Response
    {
        return $this->render('job_offer/edit.html.twig', );
    }
    
    #[Route('/job-offers/{id}/delete', name: 'app_job_offer_delete', methods: ['POST'])]
    public function delete(): Response
    {
        return $this->render('job_offer/new.html.twig', );
    }
}
