<?php

namespace App\Entity;

use App\Repository\RechnungRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RechnungRepository::class)]
class Rechnung
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $titel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $erstellungdate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bestellung = null;

    #[ORM\Column(length: 255)]
    private ?string $leistung = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zahlungart = null;

    #[ORM\Column]
    private ?float $gesamtnetto = null;

    #[ORM\Column]
    private ?float $mwst = null;

    #[ORM\Column]
    private ?float $gesamtbrutto = null;

    #[ORM\ManyToOne(inversedBy: 'rechnungs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Kunde $kunde = null;

    #[ORM\ManyToOne(inversedBy: 'rechnungs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ansteller $ansteller = null;

    #[ORM\ManyToMany(targetEntity: Bezeichnung::class, inversedBy: 'rechnungs')]
    private Collection $bezeichnungen;

    #[ORM\Column(length: 255)]
    private ?string $kundenName = null;

    #[ORM\Column(length: 255)]
    private ?string $kundenStrasse = null;

    #[ORM\Column(length: 255)]
    private ?string $kundenPlz = null;

    #[ORM\Column(length: 255)]
    private ?string $kundenOrt = null;

    public function __construct()
    {
        $this->bezeichnungen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): self
    {
        $this->titel = $titel;

        return $this;
    }

    public function getErstellungdate(): ?\DateTimeInterface
    {
        return $this->erstellungdate;
    }

    public function setErstellungdate(\DateTimeInterface $erstellungdate): self
    {
        $this->erstellungdate = $erstellungdate;

        return $this;
    }

    public function getBestellung(): ?string
    {
        return $this->bestellung;
    }

    public function setBestellung(?string $bestellung): self
    {
        $this->bestellung = $bestellung;

        return $this;
    }

    public function getLeistung(): ?string
    {
        return $this->leistung;
    }

    public function setLeistung(string $leistung): self
    {
        $this->leistung = $leistung;

        return $this;
    }

    public function getZahlungart(): ?string
    {
        return $this->zahlungart;
    }

    public function setZahlungart(?string $zahlungart): self
    {
        $this->zahlungart = $zahlungart;

        return $this;
    }

    public function getGesamtnetto(): ?float
    {
        return $this->gesamtnetto;
    }

    public function setGesamtnetto(float $gesamtnetto): self
    {
        $this->gesamtnetto = $gesamtnetto;

        return $this;
    }

    public function getMwst(): ?float
    {
        return $this->mwst;
    }

    public function setMwst(float $mwst): self
    {
        $this->mwst = $mwst;

        return $this;
    }

    public function getGesamtbrutto(): ?float
    {
        return $this->gesamtbrutto;
    }

    public function setGesamtbrutto(float $gesamtbrutto): self
    {
        $this->gesamtbrutto = $gesamtbrutto;

        return $this;
    }

    public function getKunde(): ?Kunde
    {
        return $this->kunde;
    }

    public function setKunde(?Kunde $kunde): self
    {
        $this->kunde = $kunde;

        return $this;
    }

    public function getAnsteller(): ?Ansteller
    {
        return $this->ansteller;
    }

    public function setAnsteller(?Ansteller $ansteller): self
    {
        $this->ansteller = $ansteller;

        return $this;
    }

    /**
     * @return Collection<int, Bezeichnung>
     */
    public function getBezeichnungen(): Collection
    {
        return $this->bezeichnungen;
    }

    public function addBezeichnungen(Bezeichnung $bezeichnungen): self
    {
        if (!$this->bezeichnungen->contains($bezeichnungen)) {
            $this->bezeichnungen->add($bezeichnungen);
        }

        return $this;
    }

    public function removeBezeichnungen(Bezeichnung $bezeichnungen): self
    {
        $this->bezeichnungen->removeElement($bezeichnungen);

        return $this;
    }

    public function getKundenName(): ?string
    {
        return $this->kundenName;
    }

    public function setKundenName(string $kundenName): self
    {
        $this->kundenName = $kundenName;

        return $this;
    }

    public function getKundenStrasse(): ?string
    {
        return $this->kundenStrasse;
    }

    public function setKundenStrasse(string $kundenStrasse): self
    {
        $this->kundenStrasse = $kundenStrasse;

        return $this;
    }

    public function getKundenPlz(): ?string
    {
        return $this->kundenPlz;
    }

    public function setKundenPlz(string $kundenPlz): self
    {
        $this->kundenPlz = $kundenPlz;

        return $this;
    }

    public function getKundenOrt(): ?string
    {
        return $this->kundenOrt;
    }

    public function setKundenOrt(string $kundenOrt): self
    {
        $this->kundenOrt = $kundenOrt;

        return $this;
    }
}
