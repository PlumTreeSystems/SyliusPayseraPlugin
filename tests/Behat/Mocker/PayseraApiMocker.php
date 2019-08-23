<?php

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Mocker;

use Payum\Core\Model\Payment;
use PTS\Paysera\Api;
use Sylius\Behat\Service\Mocker\MockerInterface;

final class PayseraApiMocker
{
    /**
     * @var MockerInterface
     */
    private $mocker;
    /**
     * @param MockerInterface $mocker
     */
    public function __construct(MockerInterface $mocker)
    {
        $this->mocker = $mocker;
    }
    public function mockSuccessfulPayment(callable $action)
    {
        $service = $this->mocker
            ->mockCollaborator(Api::class);
        $service->shouldReceive('doPayment');
        $action();
        $this->mocker->unmockAll();

    }
}