<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JobFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        $builder
            ->add('title', TextType::class, [
                'row_attr' => ['class' => 'flex flex-row gap-4 w-full'],
                'label' => 'Intitulé du poste',
                'label_attr' => ['class' => ' flex flex-col gap-4 text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600',
                ],
                // 'help' => 'Intitulé de l\'offre',
                // 'help_attr' => ['class' => 'text-sm text-violet-600'],
            ])
            ->add('company', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-4 w-full border-red-900'],
                'label' => 'Entreprise',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600'
                    ],
                ])
            ->add('link', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-4 w-full'],
                'label' => 'Lien vers le site de l\'entreprise',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600'
                    ],
    
            ])
            ->add('location', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-4 w-full'],
                'label' => 'Lieu',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-600'
                  ],
    
            ])
            ->add('salary', TextType::class, [
                'row_attr' => ['class' => '  flex flex-col gap-4 w-full'],
                'label' => 'Salaire',
                'label_attr' => ['class' => 'text-red-950 font-semibold w-full '],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-60'
                  ],
                ])
            ->add('contactPerson', TextType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-4 w-full'],
                'label' => 'Personne à contacter',
                'label_attr' => ['class' => 'text-red-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-60'
                  ],
            ])
            ->add('contactEmail', EmailType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-4 w-full'],
                'label' => 'Email de la personne à contacter',
                'label_attr' => ['class' => 'text-red-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-60'
                  ],
            ])
            ->add('applicationDate', DateType::class, [
                'row_attr' => ['class' => 'flex flex-col gap-4 w-full'],
                'widget' => 'single_text',
                'label' => 'Date de la demande',
                'label_attr' => ['class' => 'text-red-950 font-semibold w-full'],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'En attente',
                    'Accepté' => 'Accepté',
                    'Refusé' => 'Refusé',
                ],
                'row_attr' => ['class' => 'flex flex-col gap-4 w-full'],
                'label' => 'Statut',
                'label_attr' => ['class' => 'text-violet-950 font-semibold w-full'],
                'attr' => [
                    'class' => 'border-2 border-violet-950 rounded-md p-2 w-full focus:border-violet-60'
                  ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' =>'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-5'
                  ],
                
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
