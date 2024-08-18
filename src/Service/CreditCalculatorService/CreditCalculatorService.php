<?php

namespace App\Service\CreditCalculatorService;

use App\Entity\CreditProgram\CreditProgram;
use Doctrine\ORM\EntityManagerInterface;

class CreditCalculatorService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Расчет кредита
     * @param $price
     * @param $initialPayment
     * @param $loanTerm
     * @return array
     */
    public function calculateCredit($price, $initialPayment, $loanTerm): array
    {
        $loanPrograms = $this->entityManager->getRepository(CreditProgram::class)->findAll();
        foreach ($loanPrograms as $program) {
            $monthlyPayment = $this->calculateMonthlyPayment($price, $initialPayment, $loanTerm, $program->getInterestRate());
            if ($monthlyPayment < 10000 && $initialPayment > 200000 && $loanTerm <= 60) {
                return [
                    'programId' => $program->getId(),
                    'interestRate' => $program->getInterestRate(),
                    'monthlyPayment' => $monthlyPayment,
                    'title' => $program->getTitle()
                ];
            }
        }

        $defaultProgram = $loanPrograms[0];
        return [
            'programId' => $defaultProgram->getId(),
            'interestRate' => $defaultProgram->getInterestRate(),
            'monthlyPayment' => $this->calculateMonthlyPayment($price, $initialPayment, $loanTerm, $defaultProgram->getInterestRate()),
            'title' => $defaultProgram->getTitle()
        ];
    }

    /**
     * Алгоритм расчета
     * @param $price
     * @param $initialPayment
     * @param $loanTerm
     * @param $interestRate
     * @return int
     */
    public function calculateMonthlyPayment($price, $initialPayment, $loanTerm, $interestRate): int
    {
        $loanAmount = $price - $initialPayment;
        $monthlyInterestRate = $interestRate / 100 / 12;
        $monthlyPayment = $loanAmount * ($monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, -$loanTerm)));
        return (int) round($monthlyPayment);
    }

}