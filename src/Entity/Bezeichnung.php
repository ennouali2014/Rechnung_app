<?php

namespace App\Entity;

use App\Repository\BezeichnungRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BezeichnungRepository::class)]
class Bezeichnung
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $menge = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $einzelpreis = null;

    #[ORM\ManyToMany(targetEntity: Rechnung::class, mappedBy: 'bezeichnungen')]
    private Collection $rechnungs;

    public function __construct()
    {
        $this->rechnungs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenge(): ?float
    {
        return $this->menge;
    }

    public function setMenge(?float $menge): self
    {
        $this->menge = $menge;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEinzelpreis(): ?float
    {
        return $this->einzelpreis;
    }

    public function setEinzelpreis(float $einzelpreis): self
    {
        $this->einzelpreis = $einzelpreis;

        return $this;
    }

    /**
     * @return Collection<int, Rechnung>
     */
    public function getRechnungs(): Collection
    {
        return $this->rechnungs;
    }

    public function addRechnung(Rechnung $rechnung): self
    {
        if (!$this->rechnungs->contains($rechnung)) {
            $this->rechnungs->add($rechnung);
            $rechnung->addBezeichnungen($this);
        }

        return $this;
    }

    public function removeRechnung(Rechnung $rechnung): self
    {
        if ($this->rechnungs->removeElement($rechnung)) {
            $rechnung->removeBezeichnungen($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->description;
    }

}
