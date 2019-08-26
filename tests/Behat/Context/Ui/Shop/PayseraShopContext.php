<?php

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Sylius\Behat\Page\Shop\Checkout\CompletePageInterface;
use Sylius\Behat\Page\Shop\Order\ShowPageInterface;
use Tests\PTS\SyliusPayseraPlugin\Behat\Mocker\PayseraApiMocker;
use Tests\PTS\SyliusPayseraPlugin\Behat\Page\External\PayseraCheckoutPage;

class PayseraShopContext extends MinkContext implements Context
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
     * @var PayseraCheckoutPage
     */
    private $paymentPage;

    /**
     * @param CompletePageInterface $summaryPage
     * @param ShowPageInterface $orderDetails
     * @param PayseraApiMocker $payseraApiMocker
     * @param PayseraCheckoutPage $paymentPage
     */
    public function __construct(
        CompletePageInterface $summaryPage,
        ShowPageInterface $orderDetails,
        PayseraApiMocker $payseraApiMocker,
        PayseraCheckoutPage $paymentPage
    )
    {
        $this->summaryPage = $summaryPage;
        $this->orderDetails = $orderDetails;
        $this->payseraApiMocker = $payseraApiMocker;
        $this->paymentPage = $paymentPage;
    }

    /**
     * @When /^I confirm my order with Paysera payment$/
     */
    public function iConfirmMyOrderWithPayseraPayment()
    {
        $this->summaryPage->confirmOrder();
    }

    /**
     * @When I get redirected to Paysera
     */
    public function iGetRedirectedToPaysera(): void
    {
        $this->payseraApiMocker->mockSuccessfulPayment(function () {
            $this->paymentPage->pay();
        });
    }

}