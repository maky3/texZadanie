<?php

namespace App\Controller\Car;

use App\Modules\Car\CarModuleInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CarController  extends AbstractController
{
    /**
     * @var CarModuleInterface
     */
    private CarModuleInterface $carModule;

    public function __construct(CarModuleInterface $carModule)
    {
        $this->carModule = $carModule;
    }

    /**
     * Получение информации об одном автомобиле
     * @Route("/api/v1/cars/{id}", name="get_car_information", methods={"GET"})
     * @param int $carId
     * @return JsonResponse
     */
    public function getCarInformation(int $carId): JsonResponse
    {
        try {
            $response['response']  = $this->carModule->getCarInformationAction($carId);
        } catch (LogicException $exception){
            $response['error'] = $exception->getMessage();
        }

        return $this->json($response);

    }
    /**
     * Получение списка автомобилий
     * @Route("/api/v1/cars/{id}", name="get_car_information", methods={"GET"})
     * @return JsonResponse
     */
    public function getCarList(): JsonResponse
    {
        try {
            $response['response']  = $this->carModule->getCarListAction();
        } catch (LogicException $exception){
            $response['error'] = $exception->getMessage();
        }

        return $this->json($response);

    }
}