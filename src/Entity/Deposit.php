<?php

namespace App\Entity;

use App\Repository\DepositRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepositRepository::class)
 */
class Deposit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=DepositContent::class, mappedBy="deposit")
     */
    private $depositContents;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="deposits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=DepositLocation::class, inversedBy="deposits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $depositLocation;

    public function __construct()
    {
        $this->depositContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $depositContent->setDeposit($this);
        }

        return $this;
    }

    public function removeDepositContent(DepositContent $depositContent): self
    {
        if ($this->depositContents->removeElement($depositContent)) {
            // set the owning side to null (unless already changed)
            if ($depositContent->getDeposit() === $this) {
                $depositContent->setDeposit(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDepositLocation(): ?DepositLocation
    {
        return $this->depositLocation;
    }

    public function setDepositLocation(?DepositLocation $depositLocation): self
    {
        $this->depositLocation = $depositLocation;

        return $this;
    }
}
