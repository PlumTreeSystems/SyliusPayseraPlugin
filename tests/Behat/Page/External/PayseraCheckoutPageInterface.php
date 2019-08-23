<?php

declare(strict_types=1);

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Page\External;

use Behat\Mink\Exception\DriverException;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use FriendsOfBehat\PageObjectExtension\Page\PageInterface;

interface PayseraCheckoutPageInterface extends PageInterface
{
    /**
     * @throws UnsupportedDriverActionException
     * @throws DriverException
     */
    public function pay();

    /**
     * @throws UnsupportedDriverActionException
     * @throws DriverException
     */
    public function cancel();
}
