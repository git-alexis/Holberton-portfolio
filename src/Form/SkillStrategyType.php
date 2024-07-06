<?php

namespace App\Form;

use App\Entity\Skill;
use App\Entity\SkillStrategy;
use App\Entity\Strategy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillStrategyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('skill_id', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
            ])
            ->add('strategy_id', EntityType::class, [
                'class' => Strategy::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SkillStrategy::class,
        ]);
    }
}
