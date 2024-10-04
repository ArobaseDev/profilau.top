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
        $offers = $jr->findBy([
            'app_user' => $this->getUser(), // Filtrage des offres créées par l'utilisateur connecté
        ]);

        return $this->render('job_offer/list.html.twig' ,[
            'offers' => $offers
        ]);
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
    public function show(int $id, JobOfferRepository $jr): Response
    {
        $offer = $jr->findOneById($id);
        return $this->render('job_offer/show.html.twig',[
            'offer' => $offer,
            'date' => $offer->getApplicationDate()->format('d-m-Y')
        ] );
    }
    
    #[Route('/job-offers/{id}/edit', name: 'app_job_offer_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, JobOfferRepository $jr, EntityManagerInterface $em): Response
    {
        $offer = $jr->find($id);
        if (!$offer) {
            throw $this->createNotFoundException('No job offer found for id ' . $id);
        }

        $form = $this->createForm(JobFormType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_job_offer', [
                'id' => $offer->getId(),
            ]);
        }

        return $this->render('job_offer/edit.html.twig', [
            'jobForm' => $form->createView(),
        ]);
    }
    
    #[Route('/job-offers/{id}/delete', name: 'app_job_offer_delete', methods: ['POST'])]
    public function delete(int $id, JobOfferRepository $jr, EntityManagerInterface $em, Request $request): Response
    {
        $offer = $jr->find($id);
        if (!$offer) {
            throw $this->createNotFoundException('No job offer found for id ' . $id);
        }

        // Vérification du token CSRF pour éviter les suppressions non sécurisées
        if ($this->isCsrfTokenValid('delete' . $offer->getId(), $request->request->get('_token'))) {
            $em->remove($offer);
            $em->flush();
            $this->addFlash('success', 'Job offer successfully deleted.');
        }

        return $this->redirectToRoute('app_job_offer');
    }
}
