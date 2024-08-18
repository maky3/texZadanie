<?php

namespace App\Modules\Car\Handler;

use App\Repository\CarRepository\CarRepository;

class CarHandler
{
    /**
     * @var CarRepository
     */
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * Получение детальной информации об авто
     * @param int $carId
     * @return array
     */
    public function getCarInformation(int $carId): array
    {

        $car = $this->carRepository->getOne($carId);
        if ($car) {
            return [
                'id' => $car->getId(),
                'brand' => [
                    'id' => $car->getBrand()->getId(),
                    'name' => $car->getBrand()->getName(),
                ],
                'model' => [
                    'id' => $car->getModel()->getId(),
                    'name' => $car->getModel()->getName(),
                ],
                'photo' => $car->getPhotoPath(),
                'price' => $car->getPrice(),
            ];
        }
    }

    /**
     * Метод возращает список авто
     * @return array
     */
    public function getCarList(): array
    {
        $cars = $this->carRepository->findAllCars();

        $data = [];
        foreach ($cars as $car) {
            $data[] = [
                'id' => $car->getId(),
                'brand' => [
                    'id' => $car->getBrand()->getId(),
                    'name' => $car->getBrand()->getName(),
                ],
                'photo' => $car->getPhotoPath(),
                'price' => $car->getPrice(),
            ];
        }
        return $data;
    }
}