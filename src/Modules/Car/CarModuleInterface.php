<?php

namespace App\Modules\Car;

interface CarModuleInterface
{
    /**
     * @param int $carId
     * @return array
     */
    public function getCarInformationAction(int $carId): array;

    /**
     * @return array
     */
    public function getCarListAction(): array;
}