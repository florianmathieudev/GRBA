<?php

namespace App\Form;

use App\Entity\Header;
use App\Entity\HeadersPicture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HeaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('tab', TextType::class, array(
            //     'label' => 'Onglet du Site'
            // ))
            // ->add('title', TextType::class, array(
            //     'label' => 'Titre du site'
            // ))
            ->add('headersPictures', FileType::class, [
                'label' => 'Image principale du Site',
                
                'required'   => false,
                'multiple' => true
            ])
            // ->add('picture2', EntityType::class, [
            //     'label' => 'Deuxieme Image principale du Site (Facultatif)',
            //     'class' => HeadersPicture::class,
            //     'choice_label' => 'name',
            //     'required'   => false,
            // ])
            // ->add('picture3', EntityType::class, [
            //     'label' => 'Troisieme Image principale du Site (Facultatif)',
            //     'class' => HeadersPicture::class,
            //     'choice_label' => 'name',
            //     'required'   => false,
            // ])
            ->add('text', TextType::class, array(
                'label' => 'Texte sur la premiere image',
                'required'   => false,
            ))
            ->add('text2', TextType::class, array(
                'label' => 'Texte sur la deuxieme image',
                'required'   => false,
            ))
            ->add('text3', TextType::class, array(
                'label' => 'Texte sur la troisieme image',
                'required'   => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Header::class,
        ]);
    }
}
