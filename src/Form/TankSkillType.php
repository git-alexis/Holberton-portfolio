<?php

namespace App\Form;

use App\Entity\Skill;
use App\Entity\Tank;
use App\Entity\TankSkill;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TankSkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value')
            ->add('tank_id', EntityType::class, [
                'class' => Tank::class,
                'choice_label' => 'id',
            ])
            ->add('skill_id', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TankSkill::class,
        ]);
    }
}
