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
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('skill_id', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
				'label' => 'Skill id : ',
            ])
            ->add('strategy_id', EntityType::class, [
                'class' => Strategy::class,
                'choice_label' => 'id',
				'label' => 'Strategy id : ',
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
