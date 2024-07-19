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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegisterFormType extends AbstractType
{
    // Method to build the form fields and their configurations
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add 'name' field of type TextType with a custom label
        $builder
            ->add('name', TextType::class, [
                'label' => '* Firstname :',
            ])
            // Add 'surname' field of type TextType with a custom label
            ->add('surname', TextType::class, [
                'label' => '* Lastname :',
            ])
            // Add 'email' field of type EmailType with a custom label
            ->add('email', EmailType::class, [
                'label' => '* Email :',
            ])
            // Add 'roles' field of type ChoiceType with options and custom label
            ->add('roles', ChoiceType::class, [
                'label' => '* Roles :',
                'choices' => [
                    'User' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            // Add 'plainPassword' field of type RepeatedType for password confirmation
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => '* Password :'],
                'second_options' => ['label' => '* Repeat Password :'],
                'invalid_message' => 'The password fields must match.',
                // Prevent mapping this field directly to the User entity
                'mapped' => false,
            ])
            // Add 'register' button of type SubmitType with a custom label
            ->add('register', SubmitType::class, [
                'label' => 'Register',
            ])
        ;
    }

    // Method to configure options for this form, setting the data_class to User
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
