<?php

namespace PTS\SyliusPayseraPlugin\Action;

use PTS\Paysera\Api;
use PTS\Paysera\MockedApi;
use WhiteCube\Lingua\Service as LocaleConverter;
use Payum\Core\Bridge\Spl\ArrayObject;
use PTS\Paysera\Action\CaptureAction as BaseCaptureAction;

class CaptureAction extends BaseCaptureAction
{
    public function __construct($mocked = false)
    {
        $mocked ? $this->apiClass = MockedApi::class : $this->apiClass = Api::class;
    }
    /**
     * @param mixed $request
     * @throws \WebToPayException
     */
    public function execute($request)
    {
        $model = ArrayObject::ensureArrayObject($request->getModel());

        if (!isset($model['lang'])) {
            $locale = LocaleConverter::create($request->getFirstModel()->getOrder()->getLocaleCode());
            $model['lang'] = strtoupper($locale->toIso_639_2b());
        }
        parent::execute($request);
    }
}
