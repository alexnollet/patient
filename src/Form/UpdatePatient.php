<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class UpdatePatient extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['required' => false,])
            ->add('prenom', TextType::class, ['required' => false,])
            ->add('num', TextType::class, ['required' => false,])
            ->add('adresse', TextType::class, ['required' => false,])
            ->add('save', SubmitType::class)
        ;
    }
}
