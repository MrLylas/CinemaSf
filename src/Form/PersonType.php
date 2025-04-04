<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Comedian;
use App\Entity\Director;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('forename')
            ->add('nationality')
            ->add('birthdate', null, [
                'widget' => 'single_text',
            ])
            ->add('gender')
            ->add('poster', FileType::class, [
                'label' => 'Poster (PNG file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File ([
                        'maxSize' => '5000k',
                        'mimeTypes' => ['image/jpeg','image/png','image/webp'],
                        'mimeTypesMessage' => 'Please upload a valid Image File (jpg, jpeg, png, webp)',
                        'maxSizeMessage' => 'The image file is too large . Allowed size is 5MB',
                    ])
                ]
            ])
            // ->add('director', EntityType::class, [
            //     'class' => Director::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('comedian', EntityType::class, [
            //     'class' => Comedian::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
