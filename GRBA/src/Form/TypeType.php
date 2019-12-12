<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Picture;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre du Type'
            ))
            ->add('code', TextType::class, array(
                'label' => 'Code du Type'
            ))
            ->add('picture', EntityType::class, [
                'class' => Picture::class,
                'choice_label' => 'name',
                'required'   => false,
                'label' => 'Selectionner l\'Image du Type'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Type::class,
        ]);
    }
}
