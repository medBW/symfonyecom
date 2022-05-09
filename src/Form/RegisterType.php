<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'votre prénom',
                'constraints' => new Length(30,2),
                'attr' => [
                    'placeholder' => 'merci de saisir votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'constraints' => new Length(30,2),
                'label' => 'votre nom',
                'attr' => [
                    'placeholder' => 'merci de saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => new Length(60,2),
                'label' => 'votre email',
                'attr' => [
                    'placeholder' => 'merci de saisir votre email'
                ]
            ])
            //->add('roles')
            ->add('password', RepeatedType::class, [
                'constraints' => new Length(30,2),
                'type' => PasswordType::class,
                'invalid_message' => 'le mot de passe et la confirmation doivent être identique',
                'label' => 'votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label'=>'mot de passe',
                    'attr' => [
                        'placeholder' => 'merci de saisir votre mot de passe'
                    ]
                ],
                'second_options' => [
                    'label'=>'mot de passe',
                    'attr' => [
                        'placeholder' => 'merci de confirmer votre mot de passe'
                    ]
                ],
            ])
            ->add('submit', SubmitType::class,[
                'label' => "s'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
