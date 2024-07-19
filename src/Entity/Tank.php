<?php

namespace App\Entity;

use App\Repository\TankRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TankRepository::class)]
class Tank
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, TankSkill>
     */
    #[ORM\OneToMany(targetEntity: TankSkill::class, mappedBy: 'tank_id')]
    private Collection $tankSkills;

    #[ORM\Column(length: 255)]
    private ?string $created_by = null;

    public function __construct()
    {
        $this->tankSkills = new ArrayCollection();
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
     * @return Collection<int, TankSkill>
     */
    public function getTankSkills(): Collection
    {
        return $this->tankSkills;
    }

    public function addTankSkill(TankSkill $tankSkill): static
    {
        if (!$this->tankSkills->contains($tankSkill)) {
            $this->tankSkills->add($tankSkill);
            $tankSkill->setTankId($this);
        }

        return $this;
    }

    public function removeTankSkill(TankSkill $tankSkill): static
    {
        if ($this->tankSkills->removeElement($tankSkill)) {
            // set the owning side to null (unless already changed)
            if ($tankSkill->getTankId() === $this) {
                $tankSkill->setTankId(null);
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
