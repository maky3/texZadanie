<?php

namespace App\Modules\Credit\CreditClass;

class GetCreditCalculateClass
{
    /**
     * @var int|null
     */
    private ?int $price;

    /**
     * @var float|null
     */
    private ?float $initialPayment;

    /**
     * @var int|null
     */
    private ?int $loanTerm;

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return GetCreditCalculateClass
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;
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
     * @return GetCreditCalculateClass
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
     * @return GetCreditCalculateClass
     */
    public function setLoanTerm(int $loanTerm): self
    {
        $this->loanTerm = $loanTerm;
        return $this;
    }
}