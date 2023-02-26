<?php

namespace App\Form;

use App\Entity\Bezeichnung;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BezeichnungType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menge')
            ->add('description')
            ->add('einzelpreis')
            ->add('rechnungs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bezeichnung::class,
        ]);
    }
}
