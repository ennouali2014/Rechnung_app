<?php

namespace App\Form;

use App\Entity\Ansteller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnstellerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('strasse')
            ->add('plz')
            ->add('ort')
            ->add('steuerNr')
            ->add('bank')
            ->add('kontonummer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ansteller::class,
        ]);
    }
}
