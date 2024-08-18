<?php

namespace App\Modules\Credit\Handler;

use App\Entity\CreditApplication\CreditApplication;
use App\Modules\Credit\Service\creditParseService;
use App\Repository\CarRepository\CarRepository;
use App\Repository\CreditApplicationRepository\CreditApplicationRepository;
use App\Repository\CreditProgramRepository\CreditProgramRepository;
use App\Service\CreditCalculatorService\CreditCalculatorService;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class CreditHandler
{
    /**
     * @var creditParseService
     */
    private creditParseService $creditParseService;

    /**
     * @var CreditCalculatorService
     */
    private CreditCalculatorService $creditCalculatorService;

    /**
     * @var CreditApplicationRepository
     */
    private CreditApplicationRepository $creditApplicationRepository;

    /**
     * @var CarRepository
     */
    private CarRepository $carRepository;

    /**
     * @var CreditProgramRepository
     */
    private CreditProgramRepository $creditProgramRepository;

    public function __construct(CreditParseService $creditParseService,
                                CreditCalculatorService  $creditCalculatorService,
                                CreditApplicationRepository $creditApplicationRepository,
                                CreditProgramRepository $creditProgramRepository,
                                CarRepository $carRepository)
    {
        $this->creditParseService = $creditParseService;
        $this->creditCalculatorService = $creditCalculatorService;
        $this->creditApplicationRepository = $creditApplicationRepository;
        $this->carRepository = $carRepository;
        $this->creditProgramRepository = $creditProgramRepository;
    }

    /**
     * Расчет кредита по указанным параметрам из кредитной формы
     * @param Request $request
     * @return array
     */
    public function getCreditCalculate(Request $request): array
    {
        $data = $this->creditParseService->parseGetCreditCalculateRequest($request);

        $price = $data->getPrice();
        $initialPayment = $data->getInitialPayment();
        $loanTerm = $data->getLoanTerm();

        return $this->creditCalculatorService->calculateCredit($price, $initialPayment, $loanTerm);
    }

    /**
     * Сохранение заявки с указанными параметрами из кредитной формы
     * @param Request $request
     * @return array|true[]
     */
    public function createCreditApplication(Request $request): array
    {
        $parsedCreditApplication = $this->creditParseService->parseCreateCreditApplicationRequest($request);

        if (!$parsedCreditApplication->getCarId() || !$parsedCreditApplication->getProgramId() || !$parsedCreditApplication->getInitialPayment() || !$parsedCreditApplication->getLoanTerm()) {
            return ['success' => false, 'message' => 'Нужные данные не переданы'];
        }

        $car = $this->carRepository->find($parsedCreditApplication->getCarId());
        $program = $this->creditProgramRepository->find($parsedCreditApplication->getProgramId());

        if (!$car || !$program) {
            return ['success' => false, 'message' => 'Car или CreditProgram не найдены'];
        }

        $creditApplication = new CreditApplication();
        $creditApplication->setCar($car);
        $creditApplication->setProgram($program);
        $creditApplication->setInitialPayment($parsedCreditApplication->getInitialPayment());
        $creditApplication->setLoanTerm($parsedCreditApplication->getLoanTerm());

        try {
            $this->creditApplicationRepository->setCreate($creditApplication);
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}