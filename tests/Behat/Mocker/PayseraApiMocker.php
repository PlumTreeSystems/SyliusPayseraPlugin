<?php

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Mocker;

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
}