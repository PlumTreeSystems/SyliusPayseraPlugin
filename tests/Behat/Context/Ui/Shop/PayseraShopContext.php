<?php

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Sylius\Behat\Page\Shop\Checkout\CompletePageInterface;
use Sylius\Behat\Page\Shop\Order\ShowPageInterface;
use Tests\PTS\SyliusPayseraPlugin\Behat\Mocker\PayseraApiMocker;
use Tests\PTS\SyliusPayseraPlugin\Behat\Page\JQueryHelper;

class PayseraShopContext implements Context
{
    /**
     * @var CompletePageInterface
     */
    private $summaryPage;
    /**
     * @var ShowPageInterface
     */
    private $orderDetails;
    /**
     * @var PayseraApiMocker
     */
    private $payseraApiMocker;

    /**
     * @param CompletePageInterface $summaryPage
     * @param ShowPageInterface $orderDetails
     * @param PayseraApiMocker $payseraApiMocker
     */
    public function __construct(
        CompletePageInterface $summaryPage,
        ShowPageInterface $orderDetails,
        PayseraApiMocker $payseraApiMocker
    )
    {
        $this->summaryPage = $summaryPage;
        $this->orderDetails = $orderDetails;
        $this->payseraApiMocker = $payseraApiMocker;
    }

    /**
     * @When /^I confirm my order with Paysera payment$/
     */
    public function iConfirmMyOrderWithPayseraPayment()
    {
        $this->summaryPage->confirmOrder();
    }
}