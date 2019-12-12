<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class, array(
                'attr' => array(
                    'label' => 'Chemin de l\'Image',
                    'mapped' => false,
                    'accept' =>'image/*',
                    'multiple' => true,
                    'data_class' => null,
                    
                )))
                ->add('name', TextType::class, array(
                    'label' => 'Nom de l\'Image'
                ))
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'place',
                'required'   => false,
                'empty_data' => null,
                'label' => 'Selectionner l\'Evenement auquel vous voulez lier cette Image',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
