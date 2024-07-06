<?php

namespace App\Entity;

use App\Repository\SkillStrategyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillStrategyRepository::class)]
class SkillStrategy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'skillStrategies')]
    private ?Skill $skill_id = null;

    #[ORM\ManyToOne(inversedBy: 'skillStrategies')]
    private ?Strategy $strategy_id = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStrategyId(): ?Strategy
    {
        return $this->strategy_id;
    }

    public function setStrategyId(?Strategy $strategy_id): static
    {
        $this->strategy_id = $strategy_id;

        return $this;
    }
}
