<?php

namespace App\Entity;

use App\Repository\AnstellerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnstellerRepository::class)]
class Ansteller
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $strasse = null;

    #[ORM\Column(length: 255)]
    private ?string $plz = null;

    #[ORM\Column(length: 255)]
    private ?string $ort = null;

    #[ORM\Column(length: 255)]
    private ?string $steuerNr = null;

    #[ORM\Column(length: 255)]
    private ?string $bank = null;

    #[ORM\Column(length: 255)]
    private ?string $kontonummer = null;

    #[ORM\OneToMany(mappedBy: 'ansteller', targetEntity: Rechnung::class)]
    private Collection $rechnungs;

    public function __construct()
    {
        $this->rechnungs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStrasse(): ?string
    {
        return $this->strasse;
    }

    public function setStrasse(string $strasse): self
    {
        $this->strasse = $strasse;

        return $this;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setPlz(string $plz): self
    {
        $this->plz = $plz;

        return $this;
    }

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setOrt(string $ort): self
    {
        $this->ort = $ort;

        return $this;
    }

    public function getSteuerNr(): ?string
    {
        return $this->steuerNr;
    }

    public function setSteuerNr(string $steuerNr): self
    {
        $this->steuerNr = $steuerNr;

        return $this;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(string $bank): self
    {
        $this->bank = $bank;

        return $this;
    }

    public function getKontonummer(): ?string
    {
        return $this->kontonummer;
    }

    public function setKontonummer(string $kontonummer): self
    {
        $this->kontonummer = $kontonummer;

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
            $rechnung->setAnsteller($this);
        }

        return $this;
    }

    public function removeRechnung(Rechnung $rechnung): self
    {
        if ($this->rechnungs->removeElement($rechnung)) {
            // set the owning side to null (unless already changed)
            if ($rechnung->getAnsteller() === $this) {
                $rechnung->setAnsteller(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->name;
    }

}
