<?php

namespace App\Form;

use App\Entity\Skill;
use App\Entity\Tank;
use App\Entity\TankSkill;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TankSkillType extends AbstractType
{
    // Method to build the form fields and their configurations
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add 'value' field of type TextType with a custom label
        $builder
            ->add('value', TextType::class, [
                'label' => 'Value :', // Label for the 'value' field
            ])
            // Add 'tank_id' field of type EntityType to select a Tank entity
            ->add('tank_id', EntityType::class, [
                'class' => Tank::class, // The entity class for the 'tank_id' field
                'choice_label' => 'id', // Field to display for choices
                'label' => 'Tank id : ', // Label for the 'tank_id' field
            ])
            // Add 'skill_id' field of type EntityType to select a Skill entity
            ->add('skill_id', EntityType::class, [
                'class' => Skill::class, // The entity class for the 'skill_id' field
                'choice_label' => 'id', // Field to display for choices
                'label' => 'Skill id : ', // Label for the 'skill_id' field
            ])
        ;
    }

    // Method to configure options for this form, setting the data_class to TankSkill
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TankSkill::class, // The class that the form data will be mapped to
        ]);
    }
}
