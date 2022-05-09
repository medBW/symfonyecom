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

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'mon adresse email'
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'mon prénom'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'mon nom'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'mon mot de passe actuel',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'constraints' => new Length(30,2),
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'le mot de passe et la confirmation doivent être identique',
                'label' => 'votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label'=>'nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'merci de saisir votre nouveau mot de passe'
                    ]
                ],
                'second_options' => [
                    'label'=>'confirmer nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'merci de confirmer votre nouveau mot de passe'
                    ]
                ],
            ])
            ->add('submit', SubmitType::class,[
                'label' => "mettre à jour"
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
