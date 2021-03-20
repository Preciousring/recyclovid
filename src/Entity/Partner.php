<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartnerRepository::class)
 */
class Partner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @ORM\ManyToMany(targetEntity=DepositLocation::class, inversedBy="partners")
     */
    private $depositLocations;

    public function __construct()
    {
        $this->depositLocations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return Collection|DepositLocation[]
     */
    public function getDepositLocations(): Collection
    {
        return $this->depositLocations;
    }

    public function addDepositLocation(DepositLocation $depositLocation): self
    {
        if (!$this->depositLocations->contains($depositLocation)) {
            $this->depositLocations[] = $depositLocation;
        }

        return $this;
    }

    public function removeDepositLocation(DepositLocation $depositLocation): self
    {
        $this->depositLocations->removeElement($depositLocation);

        return $this;
    }


}
