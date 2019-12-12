<?php

namespace App\Form;

use App\Entity\Header;
use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HeaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tab', TextType::class, array(
                'label' => 'Onglet du Site'
            ))
            ->add('title', TextType::class, array(
                'label' => 'Titre du site'
            ))
            ->add('picture', EntityType::class, [
                'label' => 'Image principale du Site',
                'class' => Picture::class,
                'choice_label' => 'name',
                'required'   => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Header::class,
        ]);
    }
}
