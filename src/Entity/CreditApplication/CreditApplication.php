<?php

namespace App\Entity\CreditApplication;

use App\Entity\Car\Car;
use App\Entity\CreditProgram\CreditProgram;
use App\Repository\CreditApplicationRepository\CreditApplicationRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CreditApplication::class)]
#[ORM\Table(name: '`credit_application`')]
class CreditApplication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(name: "car_id", referencedColumnName: "id")]
    private Car $car;

    #[ORM\ManyToOne(targetEntity: CreditProgram::class)]
    #[ORM\JoinColumn(name: "program_id", referencedColumnName: "id")]
    private CreditProgram $program;

    #[ORM\Column(type: "float")]
    private float $initialPayment;

    #[ORM\Column(type: "integer")]
    private int $loanTerm;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Car|null
     */
    public function getCar(): ?Car
    {
        return $this->car;
    }

    /**
     * @param Car $car
     * @return $this
     */
    public function setCar(Car $car): self
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return CreditProgram|null
     */
    public function getProgram(): ?CreditProgram
    {
        return $this->program;
    }

    /**
     * @param CreditProgram $program
     * @return $this
     */
    public function setProgram(CreditProgram $program): self
    {
        $this->program = $program;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getInitialPayment(): ?float
    {
        return $this->initialPayment;
    }

    /**
     * @param float $initialPayment
     * @return $this
     */
    public function setInitialPayment(float $initialPayment): self
    {
        $this->initialPayment = $initialPayment;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLoanTerm(): ?int
    {
        return $this->loanTerm;
    }

    /**
     * @param int $loanTerm
     * @return $this
     */
    public function setLoanTerm(int $loanTerm): self
    {
        $this->loanTerm = $loanTerm;
        return $this;
    }

}