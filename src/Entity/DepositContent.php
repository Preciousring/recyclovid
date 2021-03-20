<?php

namespace App\Entity;

use App\Repository\DepositContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepositContentRepository::class)
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="unique_deposit", columns={"quantity", "mask_type_id", "deposit_id"})})
 */
class DepositContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=MaskType::class, inversedBy="depositContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $maskType;

    /**
     * @ORM\ManyToOne(targetEntity=Deposit::class, inversedBy="depositContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deposit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMaskType(): ?MaskType
    {
        return $this->maskType;
    }

    public function setMaskType(?MaskType $maskType): self
    {
        $this->maskType = $maskType;

        return $this;
    }

    public function getDeposit(): ?Deposit
    {
        return $this->deposit;
    }

    public function setDeposit(?Deposit $deposit): self
    {
        $this->deposit = $deposit;

        return $this;
    }
}
