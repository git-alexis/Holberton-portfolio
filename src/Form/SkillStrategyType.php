<?php

namespace App\Form;

use App\Entity\Skill;
use App\Entity\SkillStrategy;
use App\Entity\Strategy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SkillStrategyType extends AbstractType
{
    // Method to build the form fields and their configurations
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add 'skill_id' field of type EntityType to select a Skill entity
        $builder
            ->add('skill_id', EntityType::class, [
                'class' => Skill::class, // The entity class to use for this field
                'choice_label' => 'id',  // Field to display for choices
                'label' => 'Skill id : ', // Label for the field
            ])
            // Add 'strategy_id' field of type EntityType to select a Strategy entity
            ->add('strategy_id', EntityType::class, [
                'class' => Strategy::class, // The entity class to use for this field
                'choice_label' => 'id',  // Field to display for choices
                'label' => 'Strategy id : ', // Label for the field
            ])
        ;
    }

    // Method to configure options for this form, setting the data_class to SkillStrategy
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SkillStrategy::class, // The class that the form data will be mapped to
        ]);
    }
}
