<?php

namespace App\Form;

use App\Entity\HeaderMainPage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class HeaderMainPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('picturePath1', FileType::class, [
                        'label' => 'Image principale du Site',
                        
                        'required'   => false,
                        'multiple' => false
        ])
                ->add('text1', TextareaType::class)
                
                ->add('picturePath2', FileType::class, [
                    'label' =>'Deuxième image',
                    'required'   => false,
                    'multiple' => false
                ])
                ->add('text2', TextareaType::class)
                ->add('picturePath3', FileType::class, [
                    'label' =>'Troisième image',
                    'required'   => false,
                    'multiple' => false
                ])
                ->add('text3', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HeaderMainPage::class,
        ]);
    }
}
