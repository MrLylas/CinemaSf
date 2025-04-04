<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\Movie;
use App\Entity\Casting;
use App\Entity\Comedian;
use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CastingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('movie', EntityType::class, [
                'class' => Movie::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('comedian', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Casting::class,
        ]);
    }
}
