<?php

namespace App\Entity;

use App\Repository\TankSkillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TankSkillRepository::class)]
class TankSkill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\ManyToOne(inversedBy: 'tankSkills')]
    private ?Tank $tank_id = null;

    #[ORM\ManyToOne(inversedBy: 'tankSkills')]
    private ?Skill $skill_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getTankId(): ?Tank
    {
        return $this->tank_id;
    }

    public function setTankId(?Tank $tank_id): static
    {
        $this->tank_id = $tank_id;

        return $this;
    }

    public function getSkillId(): ?Skill
    {
        return $this->skill_id;
    }

    public function setSkillId(?Skill $skill_id): static
    {
        $this->skill_id = $skill_id;

        return $this;
    }
}
