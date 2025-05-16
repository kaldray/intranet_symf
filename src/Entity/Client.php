<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $raison_social = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $adresse_one = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $forme_juridique = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $activite = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $siret = null;

    #[ORM\Column]
    #[Assert\Type(['type' => 'boolean'])]
    private ?bool $actif = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Charset('UTF-8')]
    private ?string $nom_prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Email]
    private ?string $email_rl = null;

    #[ORM\Column(length: 255)]
    #[Assert\Charset('UTF-8')]
    private ?string $telephone_rl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->raison_social;
    }

    public function setRaisonSocial(string $raison_social): static
    {
        $this->raison_social = $raison_social;

        return $this;
    }

    public function getAdresseOne(): ?string
    {
        return $this->adresse_one;
    }

    public function setAdresseOne(string $adresse_one): static
    {
        $this->adresse_one = $adresse_one;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getFormeJuridique(): ?string
    {
        return $this->forme_juridique;
    }

    public function setFormeJuridique(string $forme_juridique): static
    {
        $this->forme_juridique = $forme_juridique;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nom_prenom;
    }

    public function setNomPrenom(string $nom_prenom): static
    {
        $this->nom_prenom = $nom_prenom;

        return $this;
    }

    public function getEmailRl(): ?string
    {
        return $this->email_rl;
    }

    public function setEmailRl(string $email_rl): static
    {
        $this->email_rl = $email_rl;

        return $this;
    }

    public function getTelephoneRl(): ?string
    {
        return $this->telephone_rl;
    }

    public function setTelephoneRl(string $telephone_rl): static
    {
        $this->telephone_rl = $telephone_rl;

        return $this;
    }
}
