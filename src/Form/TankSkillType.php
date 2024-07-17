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
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value', TextType::class, [
			    'label' => 'Value :',
			])
            ->add('tank_id', EntityType::class, [
                'class' => Tank::class,
                'choice_label' => 'id',
				'label' => 'Tank id : ',
            ])
            ->add('skill_id', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
				'label' => 'Skill id : ',
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
