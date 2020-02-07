<?php

namespace App\Form;

use App\Entity\OtherHeaderPage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class OtherHeaderPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('headerPath', FileType::class, [
            'label' => 'Image principale du Site',
            
            'required'   => false,
            'multiple' => false
]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OtherHeaderPage::class,
        ]);
    }
}