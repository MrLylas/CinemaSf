<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Casting;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('created_at', null, [
                'label' => 'Release date',
                'widget' => 'single_text',
            ])
            ->add('duration')
            ->add('synopsis')
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
                    ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('submit', SubmitType::class)  
            // ->add('castings', EntityType::class, [
            //     'class' => Casting::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
