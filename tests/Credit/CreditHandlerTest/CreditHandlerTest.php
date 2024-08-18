<?php

namespace App\Tests\Credit\CreditHandlerTest;

use App\Entity\Car\Car;
use App\Entity\CreditApplication\CreditApplication;
use App\Entity\CreditProgram\CreditProgram;
use App\Modules\Credit\CreditClass\CreateCreditApplicationClass;
use App\Modules\Credit\CreditClass\GetCreditCalculateClass;
use App\Modules\Credit\Handler\CreditHandler;
use App\Modules\Credit\Service\CreditParseService;
use App\Repository\CarRepository\CarRepository;
use App\Repository\CreditApplicationRepository\CreditApplicationRepository;
use App\Repository\CreditProgramRepository\CreditProgramRepository;
use App\Service\CreditCalculatorService\CreditCalculatorService;
use LogicException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CreditHandlerTest extends TestCase
{
    private $creditParseServiceMock;
    private $creditCalculatorServiceMock;
    private $creditApplicationRepositoryMock;
    private $carRepositoryMock;
    private $creditProgramRepositoryMock;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->creditParseServiceMock = $this->createMock(CreditParseService::class);
        $this->creditCalculatorServiceMock = $this->createMock(CreditCalculatorService::class);
        $this->creditApplicationRepositoryMock = $this->createMock(CreditApplicationRepository::class);
        $this->creditProgramRepositoryMock = $this->createMock(CreditProgramRepository::class);
        $this->carRepositoryMock = $this->createMock(CarRepository::class);
    }

    public function testGetCreditCalculateSuccess()
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'price' => 1401000,
            'initialPayment' => 200000.56,
            'loanTerm' => 64
        ]));

        $data = new GetCreditCalculateClass();
        $data->setPrice(1401000);
        $data->setInitialPayment(200000.56);
        $data->setLoanTerm(64);

        $this->creditParseServiceMock->expects($this->once())
            ->method('parseGetCreditCalculateRequest')
            ->with($request)
            ->willReturn($data);

        $expectedResult = [
            'programId' => 1,
            'interestRate' => 12.3,
            'monthlyPayment' => 24276,
            'title' => "Alfa Energy"
        ];

        $this->creditCalculatorServiceMock->expects($this->once())
            ->method('calculateCredit')
            ->with(1401000, 200000.56, 64)
            ->willReturn($expectedResult);

        $handler = new CreditHandler($this->creditParseServiceMock, $this->creditCalculatorServiceMock, $this->creditApplicationRepositoryMock , $this->creditProgramRepositoryMock, $this->carRepositoryMock);

        $result = $handler->getCreditCalculate($request);

        $this->assertEquals($expectedResult, $result);
    }

    public function testGetCreditCalculateException()
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'price' => 1401000,
            'initialPayment' => 200000.56,
            'loanTerm' => 64
        ]));

        $this->creditParseServiceMock->expects($this->once())
            ->method('parseGetCreditCalculateRequest')
            ->with($request)
            ->willThrowException(new LogicException('Invalid data'));

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Invalid data');

        $handler = new CreditHandler($this->creditParseServiceMock, $this->creditCalculatorServiceMock, $this->creditApplicationRepositoryMock , $this->creditProgramRepositoryMock, $this->carRepositoryMock);

        $result = $handler->getCreditCalculate($request);
    }

    public function testCreateCreditApplicationSuccess()
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'carId' => 1,
            'programId' => 2,
            'initialPayment' => 10000,
            'loanTerm' => 60
        ]));

        $parsedCreditApplication = new CreateCreditApplicationClass();
        $parsedCreditApplication->setCarId(1);
        $parsedCreditApplication->setProgramId(2);
        $parsedCreditApplication->setInitialPayment(10000);
        $parsedCreditApplication->setLoanTerm(60);

        $this->creditParseServiceMock->expects($this->once())
            ->method('parseCreateCreditApplicationRequest')
            ->with($request)
            ->willReturn($parsedCreditApplication);

        $car = new Car();
        $program = new CreditProgram();

        $this->carRepositoryMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($car);

        $this->creditProgramRepositoryMock->expects($this->once())
            ->method('find')
            ->with(2)
            ->willReturn($program);

        $this->creditApplicationRepositoryMock->expects($this->once())
            ->method('setCreate')
            ->with($this->isInstanceOf(CreditApplication::class));

        $handler = new CreditHandler($this->creditParseServiceMock, $this->creditCalculatorServiceMock, $this->creditApplicationRepositoryMock , $this->creditProgramRepositoryMock, $this->carRepositoryMock);

        $result = $handler->createCreditApplication($request);

        $this->assertEquals(['success' => true], $result);
    }

    public function testCreateCreditApplicationMissingFields()
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'carId' => 1,
            'programId' => 2
        ]));

        $parsedCreditApplication = new CreateCreditApplicationClass();
        $parsedCreditApplication->setCarId(1);
        $parsedCreditApplication->setProgramId(2);

        $this->creditParseServiceMock->expects($this->once())
            ->method('parseCreateCreditApplicationRequest')
            ->with($request)
            ->willReturn($parsedCreditApplication);

        $handler = new CreditHandler($this->creditParseServiceMock, $this->creditCalculatorServiceMock, $this->creditApplicationRepositoryMock , $this->creditProgramRepositoryMock, $this->carRepositoryMock);

        $result = $handler->createCreditApplication($request);

        $this->assertEquals(['success' => false, 'message' => 'Нужные данные не переданы'], $result);
    }

}