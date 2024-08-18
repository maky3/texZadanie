<?php

namespace App\Modules\Car;

use App\Modules\Car\Handler\CarHandler;

class CarModule implements CarModuleInterface
{
    /**
     * @var CarHandler
     */
    private CarHandler $carHandler;

    public function __construct(CarHandler $carHandler)
    {
        $this->carHandler = $carHandler;
    }

    /**
     * @param int $carId
     * @return array
     */
    public function getCarInformationAction(int $carId): array
    {
        $this->carHandler->getCarInformation($carId);
    }

    /**
     * @return array
     */
    public function getCarListAction(): array
    {
        $this->carHandler->getCarList();
    }
}