<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, array(
                'label' => 'Adresse Email'
            ))
            ->add('username', TextType::class, array(
                'label' => 'Nom d\'Utilisateur'
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Mot de Passe'
            ))
            ->add('confirm_password', PasswordType::class, array(
                'label' => 'Confirmation du Mot de Passe'
            ))
            ->add('role')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
