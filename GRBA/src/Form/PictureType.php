<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class, array('data_class' => null))
            ->add('path', FileType::class, array('data_class' => null,'required' => false))
            ->add('name')
            ->add('description')
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'place',
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
