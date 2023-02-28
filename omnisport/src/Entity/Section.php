<?php

namespace App\Entity;

use App\Repository\SectionRepository;
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
}
