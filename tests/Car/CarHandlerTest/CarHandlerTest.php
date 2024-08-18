<?php

namespace App\Tests\Car\CarHandlerTest;

use App\Entity\Brand\Brand;
use App\Entity\Car\Car;
use App\Entity\Model\Model;
use App\Modules\Car\Handler\CarHandler;
use App\Repository\CarRepository\CarRepository;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class CarHandlerTest extends TestCase
{
    private CarRepository $carRepositoryMock;
    private CarHandler $carHandler;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->carRepositoryMock = $this->createMock(CarRepository::class);
        $this->carHandler = new CarHandler($this->carRepositoryMock);
    }

    public function test__construct()
    {
        $this->assertInstanceOf(CarHandler::class, $this->carHandler);
    }

    /**
     * @throws Exception
     */
    public function testGetCarList()
    {
        $carRepositoryMock = $this->createMock(CarRepository::class);

        $brandMock = $this->createMock(Brand::class);
        $carMock = $this->createMock(Car::class);

        $brandMock->expects($this->exactly(1))
        ->method('getId')
            ->willReturn(1);
        $brandMock->expects($this->exactly(1))
        ->method('getName')
            ->willReturn('Toyota');

        $carMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);
        $carMock->expects($this->exactly(2))
        ->method('getBrand')
            ->willReturn($brandMock);
        $carMock->expects($this->once())
            ->method('getPhotoPath')
            ->willReturn('path/to/photo.jpg');
        $carMock->expects($this->once())
            ->method('getPrice')
            ->willReturn(10000);

        $carRepositoryMock->expects($this->once())
            ->method('findAllCars')
            ->willReturn([$carMock]);

        $carHandler = new CarHandler($carRepositoryMock);

        $result = $carHandler->getCarList();

        $this->assertIsArray($result);

        $this->assertEquals([
            [
                'id' => 1,
                'brand' => [
                    'id' => 1,
                    'name' => 'Toyota',
                ],
                'photo' => 'path/to/photo.jpg',
                'price' => 10000,
            ]
        ], $result);
    }

    /**
     * @throws Exception
     */
    public function testGetCarInformation()
    {
        $brandMock = $this->createMock(Brand::class);
        $brandMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);
        $brandMock->expects($this->once())
            ->method('getName')
            ->willReturn('Toyota');

        $modelMock = $this->createMock(Model::class);
        $modelMock->expects($this->once())
        ->method('getId')
            ->willReturn(1);
        $modelMock->expects($this->once())
        ->method('getName')
            ->willReturn('Camry');

        $carMock = $this->createMock(Car::class);
        $carMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);
        $carMock->expects($this->exactly(2))
            ->method('getBrand')
            ->willReturn($brandMock);
        $carMock->expects($this->exactly(2))
        ->method('getModel')
            ->willReturn($modelMock);
        $carMock->expects($this->once())
            ->method('getPhotoPath')
            ->willReturn('path/to/photo.jpg');
        $carMock->expects($this->once())
            ->method('getPrice')
            ->willReturn(10000);

        $this->carRepositoryMock->expects($this->once())
            ->method('getOne')
            ->with(1)
            ->willReturn($carMock);

        $result = $this->carHandler->getCarInformation(1);


        $expected = [
            'id' => 1,
            'brand' => [
                'id' => 1,
                'name' => 'Toyota',
            ],
            'model' => [
                'id' => 1,
                'name' => 'Camry',
            ],
            'photo' => 'path/to/photo.jpg',
            'price' => 10000,
        ];


        $this->assertEquals($expected, $result);
    }

}