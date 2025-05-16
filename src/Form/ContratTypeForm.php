<?php

namespace App\Form;

use App\Entity\Application;
use App\Entity\Client;
use App\Entity\Contrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file',FileType::class, [
                "required" => true,
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('status', ChoiceType::class, [
                "choices" => [
                    'En cours de saisie' => 'En cours de saisie',
                    'En cours de signature' => 'En cours de signature',
                    'Actif' => 'Actif',
                    'Cloturé' => 'Cloturé',
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
            ->add('submit', SubmitType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
