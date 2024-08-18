<?php

namespace App\Entity\CreditProgram;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CreditProgramRepository\CreditProgramRepository;

#[ORM\Entity(repositoryClass: CreditProgram::class)]
#[ORM\Table(name: '`credit_program`')]
class CreditProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $title;

    #[ORM\Column(type: "float")]
    private float $interestRate;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getInterestRate(): ?float
    {
        return $this->interestRate;
    }

    /**
     * @param float $interestRate
     * @return $this
     */
    public function setInterestRate(float $interestRate): self
    {
        $this->interestRate = $interestRate;
        return $this;
    }
}