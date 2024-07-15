<?php

namespace App\Entity;

use App\Repository\StrategyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StrategyRepository::class)]
class Strategy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, SkillStrategy>
     */
    #[ORM\OneToMany(targetEntity: SkillStrategy::class, mappedBy: 'strategy_id')]
    private Collection $skillStrategies;

    #[ORM\Column(length: 255)]
    private ?string $created_by = null;

    public function __construct()
    {
        $this->skillStrategies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, SkillStrategy>
     */
    public function getSkillStrategies(): Collection
    {
        return $this->skillStrategies;
    }

    public function addSkillStrategy(SkillStrategy $skillStrategy): static
    {
        if (!$this->skillStrategies->contains($skillStrategy)) {
            $this->skillStrategies->add($skillStrategy);
            $skillStrategy->setStrategyId($this);
        }

        return $this;
    }

    public function removeSkillStrategy(SkillStrategy $skillStrategy): static
    {
        if ($this->skillStrategies->removeElement($skillStrategy)) {
            // set the owning side to null (unless already changed)
            if ($skillStrategy->getStrategyId() === $this) {
                $skillStrategy->setStrategyId(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?string
	{
		return $this->created_by;
	}

	public function setCreatedBy(User $user): self
	{
    	$this->created_by = $user->getName() . '.' . $user->getSurname();

    	return $this;
	}
}
