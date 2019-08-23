<?php

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Sylius\Behat\Page\Admin\PaymentMethod\CreatePageInterface;

class ManagingPaymentMethodsContext implements Context
{
    /**
     * @var CreatePageInterface
     */
    private $createPage;

    /**
     * ManagingPaymentMethodsContext constructor.
     * @param CreatePageInterface $createPage
     */
    public function __construct(CreatePageInterface $createPage)
    {
        $this->createPage = $createPage;
    }

    /**
     * @Given /^I want to create a new Paysera payment method$/
     * @throws \FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException
     */
    public function iWantToCreateANewPayseraPaymentMethod()
    {
        $this->createPage->open(['factory' => 'paysera']);
    }
    /**
     * @When I fill the Project id with :projectId
     */
    public function iConfigureItWithTestPayseraProjectId(string $projectId): void
    {
        $this->createPage->setPayseraProjectId($projectId);
    }
    /**
     * @When I fill the Project password with :password
     */
    public function iConfigureItWithTestPayseraPassword(string $password): void
    {
        $this->createPage->setPayseraPassword($password);
    }

}