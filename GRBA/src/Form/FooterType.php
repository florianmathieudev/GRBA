<?php

namespace App\Form;

use App\Entity\Footer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FooterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextType::class, array(
                'label' => 'Texte du Pied de Page'
            ))
            ->add('information', TextType::class, array(
                'label' => 'Information du Pied de Page'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Footer::class,
        ]);
    }
}
