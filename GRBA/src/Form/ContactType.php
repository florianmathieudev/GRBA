<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'Prenom'
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom'
            ))
            ->add('phone', TextType::class, array(
                'label' => 'Numero de Telephone'
            ))            
            ->add('email', TextType::class, array(
                'label' => 'Adresse Email'
            ))            
            ->add('message', TextType::class, array(
                'label' => 'Message'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
