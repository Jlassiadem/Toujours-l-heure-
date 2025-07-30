<?php
namespace App\Entity;

use App\Repository\ChauffeurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChauffeurRepository::class)]
class Chauffeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $chauffeur_id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $contact_number = null;

    #[ORM\Column]
    private ?bool $is_available = true;

    #[ORM\Column]
    private ?int $owned_by_admin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $added_date = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $license_number = null;

    public function getChauffeurId(): ?int
    {
        return $this->chauffeur_id;
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

    public function getContactNumber(): ?string
    {
        return $this->contact_number;
    }

    public function setContactNumber(string $contact_number): static
    {
        $this->contact_number = $contact_number;

        return $this;
    }

    public function isIsAvailable(): ?bool
    {
        return $this->is_available;
    }

    public function setIsAvailable(bool $is_available): static
    {
        $this->is_available = $is_available;

        return $this;
    }

    public function getOwnedByAdmin(): ?int
    {
        return $this->owned_by_admin;
    }

    public function setOwnedByAdmin(int $owned_by_admin): static
    {
        $this->owned_by_admin = $owned_by_admin;

        return $this;
    }

    public function getAddedDate(): ?\DateTimeInterface
    {
        return $this->added_date;
    }

    public function setAddedDate(\DateTimeInterface $added_date): static
    {
        $this->added_date = $added_date;

        return $this;
    }

    public function getLicenseNumber(): ?string
    {
        return $this->license_number;
    }

    public function setLicenseNumber(?string $license_number): static
    {
        $this->license_number = $license_number;

        return $this;
    }
}