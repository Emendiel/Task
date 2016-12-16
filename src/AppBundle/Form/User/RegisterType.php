<?php

namespace AppBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', null, [
                'label' => 'Nom',
                'attr' => array(
                    'required' => true,
                ),
            ])
            ->add('firstname', null, [
                'label' => 'Prénom',
                'attr' => [
                    'required' => true,
                ]
            ])
            ->add('username', null, [
                'label' => 'Identifiant',
                'attr' => array(
                    'required' => true,
                ),
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'Les e-mails doivent correspondre',
                'first_options'  => array(
                    'label' => 'E-mail',
                    'attr' => array(
                        'required' => true,
                    ),
                ),
                'second_options'  => array(
                    'label' => 'Confirmation e-mail',
                    'attr' => array(
                        'required' => true,
                    ),
                ),
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mot de passe doivent correspondre',
                'first_options'  => array(
                    'label' => 'Mot de passe',
                    'attr' => array(
                        'required' => true,
                    ),
                ),
                'second_options'  => array(
                    'label' => 'Confirmation du mot de passe',
                    'attr' => array(
                        'required' => true,
                    ),
                ),
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Inscription',
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'required' => false,
            'data_class' => 'AppBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'evo_registertype';
    }
}
