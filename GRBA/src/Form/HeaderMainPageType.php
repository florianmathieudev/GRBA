<?php

namespace App\Form;

use App\Entity\HeaderMainPage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class HeaderMainPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('picturePath1', FileType::class, [
            'label' => 'Image principale du Site',
            
            'required'   => false,
            'multiple' => false
        ])
                ->add('text1')
                
                ->add('picturePath2', FileType::class, [
                    'label' =>'Deuxième image',
                    'required'   => false,
                    'multiple' => false
                ])
                ->add('text2')
                ->add('picturePath3')
                ->add('text3')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HeaderMainPage::class,
        ]);
    }
}
