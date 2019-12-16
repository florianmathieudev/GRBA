<?php

namespace App\Form;

use App\Entity\File;
use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FilesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class, array(
                'data_class' => null,
                'label' => 'Chemin du Fichier'
                ))          
            ->add('name', TextType::class, array(
                'label' => 'Nom du Fichier'
            ))
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'label' => 'Evenement lie a ce Fichier',
                'placeholder' => 'Choisisser le Fichier ...',
                'choice_label' => 'place',
                'required'   => false,
                'empty_data' => null,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => File::class,
        ]);
    }
}
