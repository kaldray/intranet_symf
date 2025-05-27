<?php

namespace App\Form;

use App\Entity\Application;
use App\Entity\Client;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                "required" => true,
                'data_class' => null
            ])
            ->add('date', DateType::class, [
                "required" => true,
            ])
            ->add('date_echeance', DateType::class, [
                "required" => true,
            ])
            ->add('status', ChoiceType::class, [
                "choices" => [
                    'En cours de saisie' => 'En cours de saisie',
                    'En attente de règlement' => 'En attente de règlement',
                    'Réglée' => 'Réglée',
                ]
            ])
            ->add('montant_ht', IntegerType::class, [
                "required" => true,
                "attr" => [
                    "step" => 0.01,
                ]
            ])
            ->add('montant_tva', IntegerType::class, [
                "required" => true,
                "attr" => [
                    "step" => 0.01,
                ]
            ])
            ->add('montant_ttc', IntegerType::class, [
                "required" => true,
                "attr" => [
                    "step" => 0.01,
                ]
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'id',
            ])
            ->add('application', EntityType::class, [
                'class' => Application::class,
                'choice_label' => 'id',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
