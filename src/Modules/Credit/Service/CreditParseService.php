<?php

namespace App\Modules\Credit\Service;

use App\Modules\Credit\CreditClass\CreateCreditApplicationClass;
use App\Modules\Credit\CreditClass\GetCreditCalculateClass;
use App\Service\Parser\ParserService;
use LogicException;
use Symfony\Component\HttpFoundation\Request;
use UnexpectedValueException;

class CreditParseService  extends ParserService
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function parseGetCreditCalculateRequest(Request $request): GetCreditCalculateClass
    {
        $data = $this->getDataRequest($request);
        $serializer = $this->getSerializerExtractor();

        try {
            $result = $serializer->deserialize($data, GetCreditCalculateClass::class, 'json');
        } catch (UnexpectedValueException $e) {
            throw new LogicException($e->getMessage());
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return CreateCreditApplicationClass
     */
    public function parseCreateCreditApplicationRequest(Request $request): CreateCreditApplicationClass
    {
        $data = $this->getDataRequest($request);
        $serializer = $this->getSerializerExtractor();

        try {
            $result = $serializer->deserialize($data, CreateCreditApplicationClass::class, 'json');
        } catch (UnexpectedValueException $e) {
            throw new LogicException($e->getMessage());
        }

        return $result;
    }
}