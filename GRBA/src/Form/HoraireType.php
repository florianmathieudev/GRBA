<?php

namespace App\Form;

use App\Entity\Horaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HoraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('opening', TextType::class, array(
                'label' => 'Horaire d\'Ouverture'
            ))
            ->add('closing', TextType::class, array(
                'label' => 'Horaire de Fermeture'
            ))
            ->add('open', TextType::class, array(
                'label' => 'Est Ouvert'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horaire::class,
        ]);
    }
}
