<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_section = null;

    #[ORM\ManyToOne(inversedBy: 'section')]
    private ?Club $club = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Equipe::class)]
    private Collection $equipe;

    public function __construct()
    {
        $this->equipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSection(): ?string
    {
        return $this->nom_section;
    }

    public function setNomSection(string $nom_section): self
    {
        $this->nom_section = $nom_section;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipe(): Collection
    {
        return $this->equipe;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipe->contains($equipe)) {
            $this->equipe->add($equipe);
            $equipe->setSection($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        if ($this->equipe->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getSection() === $this) {
                $equipe->setSection(null);
            }
        }

        return $this;
    }
}
