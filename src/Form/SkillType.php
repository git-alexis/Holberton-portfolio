<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SkillType extends AbstractType
{
    // Method to build the form fields and their configurations
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add 'name' field of type TextType with a custom label
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name :', // Label displayed for the 'name' field
            ])
        ;
    }

    // Method to configure options for this form, setting the data_class to Skill
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class, // The class that the form data will be mapped to
        ]);
    }
}
