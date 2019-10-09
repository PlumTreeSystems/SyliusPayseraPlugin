<?php
declare(strict_types=1);

namespace Tests\PTS\SyliusPayseraPlugin\Behat\Page\External;

use Behat\Mink\Session;
use FriendsOfBehat\PageObjectExtension\Page\Page;
use Payum\Core\Security\TokenInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\BrowserKit\Client;


final class PayseraCheckoutPage extends Page implements PayseraCheckoutPageInterface
{
    /** @var RepositoryInterface */
    private $securityTokenRepository;

    /** @var Client */
    private $client;

    /**
     * @param array $parameters
     */
    public function __construct(Session $session, $parameters, RepositoryInterface $securityTokenRepository, Client $client)
    {
        parent::__construct($session, $parameters);
        $this->securityTokenRepository = $securityTokenRepository;
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function pay($data = [])
    {
        $this->getDriver()->visit($this->findToken()->getTargetUrl() . '?' . http_build_query($data));
    }

    /**
     * {@inheritdoc}
     */
    public function notify(array $data): void
    {
        $notifyToken = $this->findToken('notify');
        $this->client->request('GET', $notifyToken->getTargetUrl(), $data);
    }

    /**
     * {@inheritdoc}
     */
    public function cancel()
    {
        $this->getDriver()->visit($this->findToken()->getTargetUrl());
    }

    protected function getUrl(array $urlParameters = []): string
    {
        return \WebToPay::PAY_URL;
    }

    /**
     * @param string $type
     *
     * @return TokenInterface
     */
    private function findToken(string $type = 'capture'): TokenInterface
    {
        $tokens = [];
        /** @var TokenInterface $token */
        foreach ($this->securityTokenRepository->findAll() as $token) {
            if (strpos($token->getTargetUrl(), $type)) {
                $tokens[] = $token;
            }
        }
        if (count($tokens) > 0) {
            return end($tokens);
        }
        throw new \RuntimeException("Cannot find $type token, check if you are after proper checkout steps");
    }

}
