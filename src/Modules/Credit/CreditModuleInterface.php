<?php

namespace App\Modules\Credit;

use Symfony\Component\HttpFoundation\Request;

interface CreditModuleInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getCreditCalculateAction(Request $request): array;

    /**
     * @param Request $request
     * @return array
     */
    public function createCreditApplicationAction(Request $request): array;
}