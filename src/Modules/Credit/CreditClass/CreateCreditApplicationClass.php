<?php

namespace App\Modules\Credit\CreditClass;

class CreateCreditApplicationClass
{
    /**
     * @var int|null
     */
    private ?int $carId;

    /**
     * @var int|null
     */
    private ?int $programId;

    /**
     * @var int|null
     */
    private ?int $initialPayment = null ;

    /**
     * @var int|null
     */
    private ?int $loanTerm;

    /**
     * @return int|null
     */
    public function getCarId(): ?int
    {
        return $this->carId;
    }

    /**
     * @param int|null $carId
     * @return CreateCreditApplicationClass
     */
    public function setCarId(?int $carId): self
    {
        $this->carId = $carId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getProgramId(): ?int
    {
        return $this->programId;
    }

    /**
     * @param int|null $programId
     * @return CreateCreditApplicationClass
     */
    public function setProgramId(?int $programId): self
    {
        $this->programId = $programId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getInitialPayment(): ?int
    {
        return $this->initialPayment;
    }

    /**
     * @param int|null $initialPayment
     * @return CreateCreditApplicationClass
     */
    public function setInitialPayment(?int $initialPayment): self
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
     * @param int|null $loanTerm
     * @return CreateCreditApplicationClass
     */
    public function setLoanTerm(?int $loanTerm): self
    {
        $this->loanTerm = $loanTerm;
        return $this;
    }
}