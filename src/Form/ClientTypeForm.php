<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('raison_social', TextType::class, [
                "required" => true
            ])
            ->add('adresse_one', TextType::class, [
                "required" => true
            ])
            ->add('code_postal', TextType::class, [
                "required" => true
            ])
            ->add('ville', TextType::class, [
                "required" => true
            ])
            ->add('pays', TextType::class, [
                "required" => true
            ])
            ->add('forme_juridique', TextType::class, [
                "required" => true
            ])
            ->add('activite', TextType::class, [
                "required" => true
            ])
            ->add('siret', TextType::class, [
                "required" => true
            ])
            ->add('actif', CheckboxType::class, [])
            ->add('nom_prenom', TextType::class, [
                "required" => true
            ])
            ->add('email_rl', TextType::class, [
                "required" => true
            ])
            ->add('telephone_rl', TextType::class, [
                "required" => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
