<?php

namespace App\Form;

use App\Entity\MainHeader;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainHeaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image1', FileType::class, [
                'label' => 'Image principale du Site',
                
                'required'   => false,
                'multiple' => false
            ])
            ->add('textImage1')
            ->add('image2', FileType::class, [
                'label' => 'Image principale du Site',
                
                'required'   => false,
                'multiple' => false
            ])
            ->add('textImage2')
            ->add('image3', FileType::class, [
                'label' => 'Image principale du Site',
                
                'required'   => false,
                'multiple' => false
            ])
            ->add('textImage3')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MainHeader::class,
        ]);
    }
}
