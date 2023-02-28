<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_equipe = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $dirigeant = null;

    #[ORM\ManyToOne(inversedBy: 'equipe')]
    private ?Section $section = null;

    #[ORM\OneToMany(mappedBy: 'equipe', targetEntity: Licencie::class)]
    private Collection $licencie;

    public function __construct()
    {
        $this->licencie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nom_equipe;
    }

    public function setNomEquipe(string $nom_equipe): self
    {
        $this->nom_equipe = $nom_equipe;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDirigeant(): ?string
    {
        return $this->dirigeant;
    }

    public function setDirigeant(string $dirigeant): self
    {
        $this->dirigeant = $dirigeant;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return Collection<int, Licencie>
     */
    public function getLicencie(): Collection
    {
        return $this->licencie;
    }

    public function addLicencie(Licencie $licencie): self
    {
        if (!$this->licencie->contains($licencie)) {
            $this->licencie->add($licencie);
            $licencie->setEquipe($this);
        }

        return $this;
    }

    public function removeLicencie(Licencie $licencie): self
    {
        if ($this->licencie->removeElement($licencie)) {
            // set the owning side to null (unless already changed)
            if ($licencie->getEquipe() === $this) {
                $licencie->setEquipe(null);
            }
        }

        return $this;
    }
}
