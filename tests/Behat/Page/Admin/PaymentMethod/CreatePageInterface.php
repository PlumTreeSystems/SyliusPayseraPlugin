<?php


namespace Tests\PTS\SyliusPayseraPlugin\Behat\Page\Admin\PaymentMethod;

use Sylius\Behat\Page\Admin\PaymentMethod\CreatePageInterface as BaseCreatePageInterface;

interface CreatePageInterface extends BaseCreatePageInterface
{
    /**
     * @param string $projectId
     */
    public function setPayseraProjectId(string $projectId): void;

    /**
     * @param string $password
     */
    public function setPayseraPassword(string $password): void;


}