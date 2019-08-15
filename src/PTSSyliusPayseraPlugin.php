<?php

declare(strict_types=1);

namespace PTS\SyliusPayseraPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class PTSSyliusPayseraPlugin extends Bundle
{
    use SyliusPluginTrait;
}
