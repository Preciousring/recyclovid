<?php

namespace App\Entity;

use App\Repository\MaskTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaskTypeRepository::class)
 */
class MaskType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=DepositContent::class, mappedBy="maskType")
     */
    private $depositContents;

    public function __construct()
    {
        $this->depositContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|DepositContent[]
     */
    public function getDepositContents(): Collection
    {
        return $this->depositContents;
    }

    public function addDepositContent(DepositContent $depositContent): self
    {
        if (!$this->depositContents->contains($depositContent)) {
            $this->depositContents[] = $depositContent;
            $depositContent->setMaskType($this);
        }

        return $this;
    }

    public function removeDepositContent(DepositContent $depositContent): self
    {
        if ($this->depositContents->removeElement($depositContent)) {
            // set the owning side to null (unless already changed)
            if ($depositContent->getMaskType() === $this) {
                $depositContent->setMaskType(null);
            }
        }

        return $this;
    }
}
