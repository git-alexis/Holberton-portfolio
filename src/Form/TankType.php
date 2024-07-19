<?php

namespace App\Form;

use App\Entity\Tank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TankType extends AbstractType
{
    // Method to build the form fields and their configurations
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add 'name' field of type TextType with a custom label
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name :', // Label for the 'name' field
            ])
        ;
    }

    // Method to configure options for this form, setting the data_class to Tank
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tank::class, // The class that the form data will be mapped to
        ]);
    }
}
