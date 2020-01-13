<?php

namespace App\Form;

use App\Entity\Approach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ApproachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone', TextType::class, array(
                'label' => 'Numero de Telephone'
            ))
            ->add('email', TextType::class, array(
                'label' => 'Adresse Email'
            ))
            ->add('adresse', TextType::class, array(
                'label' => 'Adresse Postale'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Approach::class,
        ]);
    }
}
