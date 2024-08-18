<?php

namespace App\Repository\CarRepository;

use App\Entity\Car\Car;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Car[]    findAll()
 */
class CarRepository extends EntityRepository
{
    /**
     * @return Car[]
     */
    public function findAllCars(): array
    {
        return $this->findAll();
    }

    /**
     * @param int $id
     * @return Car|null
     */
    public function getOne(int $id): ?Car
    {
        return $this->find($id);
    }

}