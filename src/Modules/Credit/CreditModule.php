<?php

namespace App\Modules\Credit;

use App\Modules\Credit\Handler\CreditHandler;
use Symfony\Component\HttpFoundation\Request;

class CreditModule implements CreditModuleInterface
{
    /**
     * @var CreditHandler
     */
    private CreditHandler $creditHandler;

    public function __construct(CreditHandler $handler)
    {
        $this->creditHandler = $handler;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCreditCalculateAction(Request $request): array
    {
        $this->creditHandler->getCreditCalculate($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function  createCreditApplicationAction(Request $request): array
    {
        $this->creditHandler->createCreditApplication($request);
    }


}