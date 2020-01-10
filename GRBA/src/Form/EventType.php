<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, array(
                'label' => 'Date de l\'Evenement'
            ))
            ->add('place', TextType::class, array(
                'label' => 'Lieu de l\'Evenement'
            ))
            ->add('description', TextType::class, array(
                'label' => 'Description de l\'Evenement'
                
            ))
            ->add('content', TextType::class, array( 
                'label' => 'Contenu de l\'Evenement',
                'required'   => false,
            ))
            ->add('type')
            ->add('pictures', EntityType::class, [
                'label' => 'Selectionner une Image',
                'class' => Picture::class,
                'required'   => false,
                'mapped' => false,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
