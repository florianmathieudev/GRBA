<?php

namespace App\Form;

use App\Entity\Header;
use App\Entity\HeadersPicture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HeadersPictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('path', FileType::class, array(
            'data_class' => null,
            'label' => 'Chemin de l\'Image',
            'multiple' => true
            ))
        ->add('name', TextType::class, array(
            'label' => 'Nom de l\'Image'
        ));
        // ->add('header', EntityType::class, [
        //     'class' => Header::class,
        //     'label' => 'Header lie a cette Image',
        //     'placeholder' => 'Choisisser le Header ...',
        //     'choice_label' => 'title',
        //     'required'   => false,
        //     'empty_data' => null,
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HeadersPicture::class,
        ]);
    }
}
