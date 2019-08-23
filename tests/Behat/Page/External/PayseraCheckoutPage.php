<?php
declare(strict_types=1);

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Page\External;

use Behat\Mink\Session;
use FriendsOfBehat\PageObjectExtension\Page\Page;
use Payum\Core\Security\TokenInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;


final class PayseraCheckoutPage extends Page implements PayseraCheckoutPageInterface
{
    /** @var RepositoryInterface */
    private $securityTokenRepository;

    /**
     * @param array $parameters
     */
    public function __construct(Session $session, $parameters, RepositoryInterface $securityTokenRepository)
    {
        parent::__construct($session, $parameters);
        $this->securityTokenRepository = $securityTokenRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function pay()
    {
        $this->getDriver()->visit($this->findCaptureToken()->getTargetUrl());
    }

    /**
     * {@inheritdoc}
     */
    public function cancel()
    {
        $this->getDriver()->visit($this->findCaptureToken()->getTargetUrl());
    }

    protected function getUrl(array $urlParameters = []): string
    {
        return \WebToPay::PAY_URL;
    }

    /**
     * @return TokenInterface
     *
     * @throws \RuntimeException
     */
    private function findCaptureToken()
    {
        $tokens = $this->securityTokenRepository->findAll();
        /** @var TokenInterface $token */
        foreach ($tokens as $token) {
            if (strpos($token->getTargetUrl(), 'capture')) {
                return $token;
            }
        }
        throw new \RuntimeException('Cannot find capture token, check if you are after proper checkout steps');
    }
}
