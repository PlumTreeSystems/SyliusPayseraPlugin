<?php

declare(strict_types=1);

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Page\Admin\PaymentMethod;

use Sylius\Behat\Page\Admin\PaymentMethod\CreatePage as BaseCreatePage;

final class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    public function setPayseraProjectId(string $projectId): void
    {
        $this->getDocument()->fillField('Project id', $projectId);
    }

    public function setPayseraPassword(string $password): void
    {
        $this->getDocument()->fillField('Project password', $password);
    }


}