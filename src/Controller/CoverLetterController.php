<?php

namespace App\Controller;

use Gemini;
use App\Entity\CoverLetter;
use App\Service\GeminiService;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CoverLetterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[IsGranted('IS_AUTHENTICATED_FULLY')]
class CoverLetterController extends AbstractController
{
    #[Route('/cover-letter/{id}', name: 'app_cover_letter', methods:['GET'])]
    public function show(CoverLetterRepository $cr, int $id): Response
    {
        $coverLetter = $cr->findOneById($id);
        return $this->render('cover_letter/show.html.twig', [
            'letter' => $coverLetter,
        ]);
    }
    
    #[Route('/cover-letter/generate', name: 'app_cover_letter_generate', methods:['POST'])]
    public function generate(GeminiService $gs, JobOfferRepository $jr, Request $request, EntityManagerInterface $em): Response
    {
        // Récupération de l'id  de l'annonce passé en POST
         $id = $request->request->get('job_offer_id');
     //    dd($this->getUser());
         // Utilisation du service GeminiService pour générer la lettre de motivation
        $offer = $jr->findOneById($id);
        $result = $gs->generateCoverLetter(
        'Génere moi une lettre de motivation en réponse d\'une annonce avec comme informations :
        titre : ' . $offer->getTitle() . 
        'Nom de la société ' . $offer->getCompany() .
        'Nom du contact dans la société à contacter si la valeur n\'est pas null ' . $offer->getContactPerson() .
        'Email du contact dans la société à contacter si la valeur n\'est pas null ' . $offer->getContactEmail() .
        'Prénom de l\'expediteur ' . $this->getUser()->getFirstName() .
        'Nom de l\'expediteur  ' . $this->getUser()->getLastName() .
        'Email de l\'expediteur  ' . $this->getUser()->getLastName() .
        '. Ajoute également des experiences dans le domaine. Formates moi le tout pour un affichage propre en html, c\'est à dire dès que tu rencontres un saut de ligne, ajoutes moi deux balises br. 
        Merci de ne pas oublier de mettre le nom de la société et les informations de contact de la personne à contacter dans le texte de la lettre de motivation. Ces informations sont plus que nécessaires et doivent toujours figurées.
         N\'oublies pas de mettre l\'entête de corps d\'une lettre avec nom, prénom de l\'expediteur(données obligatoires). Espaces également les paragraphes.
         Ne pas mettre les balises : html, head, body, mais tu peux mettre les balises de titres et de paragraphes.
       ');
        // Persistance du resultat
        $coverLetter = new CoverLetter;
        $coverLetter
            ->setContent($result->text())
            ->setJobOffer($offer)
            ->setAppUser($this->getUser())
            ;
         $em->persist($coverLetter);
         $em->flush();
        // Redirection vers la page de visualisation de la lettre de motivation générée
       return $this->redirectToRoute('app_cover_letter', [
        'id' => $coverLetter->getId(),
    ]);

    }
}
