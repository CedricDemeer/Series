<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Serie\'s name',
                'attr' => ['class' => 'overview-txt']])
            ->add('overview')
            ->add('status')
            ->add('vote')
            ->add('popularity')
            ->add('genres')
            ->add('firstAirDate')
            ->add('lastAirDate')
            ->add('backdrop')
            ->add('poster')
            ->add('tmdbId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
