<?php

namespace App\Repository\CreditApplicationRepository;

use App\Entity\CreditApplication\CreditApplication;
use Doctrine\ORM\EntityManagerInterface;

class CreditApplicationRepository
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
     * @param CreditApplication $creditApplication
     * @return void
     */
    public function setCreate(CreditApplication $creditApplication): void
    {
        $this->entityManager->persist($creditApplication);

        $this->entityManager->flush();
    }
}