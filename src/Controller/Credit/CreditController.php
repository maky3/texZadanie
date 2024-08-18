<?php

namespace App\Controller\Credit;

use App\Modules\Credit\CreditModuleInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreditController extends AbstractController
{
    private CreditModuleInterface $creditModule;

    public function __construct(CreditModuleInterface $creditModule)
    {
        $this->creditModule = $creditModule;
    }

    /**
     *  Получение расчета кредита
     * @Route("/api/v1/credit/calculate", name="get_credit_calculate", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getCreditCalculate(Request $request): JsonResponse
    {
        try {
            $response['response']  = $this->creditModule->getCreditCalculateAction($request);
        } catch (LogicException $exception){
            $response['error'] = $exception->getMessage();
        }

        return $this->json($response);

    }

    /**
     *  Получение расчета кредита
     * @Route("/api/v1/request", name="create_credit_application", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createCreditApplication(Request $request): JsonResponse
    {
        try {
            $response['response']  = $this->creditModule-> createCreditApplicationAction($request);
        } catch (LogicException $exception){
            $response['error'] = $exception->getMessage();
        }

        return $this->json($response);

    }

}

