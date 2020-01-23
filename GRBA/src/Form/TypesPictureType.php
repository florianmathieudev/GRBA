<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\TypesPicture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypesPictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class, array(
                'data_class' => null,
                'label' => 'Chemin de l\'Image',
                ))
            ->add('name', TextType::class, array(
                'label' => 'Nom de l\'Image'
            ))
            // ->add('type', EntityType::class, [
            //     'class' => Type::class,
            //     'label' => 'Type lie a cette Image',
            //     'placeholder' => 'Choisisser le Type ...',
            //     'choice_label' => 'title',
            //     'required'   => false,
            //     'empty_data' => null,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypesPicture::class,
        ]);
    }
}
