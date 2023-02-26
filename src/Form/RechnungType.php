<?php

namespace App\Form;

use App\Entity\Rechnung;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechnungType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel')
            ->add('erstellungdate')
            ->add('bestellung')
            ->add('leistung')
            ->add('zahlungart')
            ->add('gesamtnetto')
            ->add('mwst')
            ->add('gesamtbrutto')
            ->add('kundenName')
            ->add('kundenStrasse')
            ->add('kundenPlz')
            ->add('kundenOrt')
            ->add('kunde')
            ->add('ansteller')
            ->add('bezeichnungen')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rechnung::class,
        ]);
    }
}
