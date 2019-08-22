<?php


namespace Tests\PTS\SyliusPayseraPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Doctrine\Common\Persistence\ObjectManager;
use PTS\Paysera\PayseraGatewayFactory;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\ExampleFactoryInterface;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Sylius\Component\Core\Repository\PaymentMethodRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class PayseraContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;
    /**
     * @var PaymentMethodRepositoryInterface
     */
    private $paymentMethodRepository;
    /**
     * @var ExampleFactoryInterface
     */
    private $paymentMethodExampleFactory;
    /**
     * @var ObjectManager
     */
    private $paymentMethodManager;

    /**
     * @param SharedStorageInterface $sharedStorage
     * @param PaymentMethodRepositoryInterface $paymentMethodRepository
     * @param ExampleFactoryInterface $paymentMethodExampleFactory
     * @param ObjectManager $paymentMethodManager
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        ExampleFactoryInterface $paymentMethodExampleFactory,
        ObjectManager $paymentMethodManager
    )
    {
        $this->sharedStorage = $sharedStorage;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->paymentMethodExampleFactory = $paymentMethodExampleFactory;
        $this->paymentMethodManager = $paymentMethodManager;
    }

    /**
     * @Given the store has a payment method :paymentMethodName with a code :paymentMethodCode and Paysera payment gateway
     */
    public function theStoreHasAPaymentMethodWithACodeAndPayseraPaymentGateway(string $paymentMethodName, string $paymentMethodCode): void
    {
        $paymentMethod = $this->createPaymentMethodPaysera(
            $paymentMethodName,
            $paymentMethodCode,
            'paysera',
            'Paysera'
        );
        $paymentMethod->getGatewayConfig()->setConfig([
            'projectid' => 'test',
            'sign_password' => 'test',
            'test' => true,
        ]);
        $this->paymentMethodManager->flush();
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $factoryName
     * @param string $description
     * @param bool $addForCurrentChannel
     * @param int|null $position
     *
     * @return PaymentMethodInterface
     */
    private function createPaymentMethodPaysera(
        string $name,
        string $code,
        string $factoryName,
        string $description = '',
        bool $addForCurrentChannel = true,
        int $position = null
    ): PaymentMethodInterface
    {
        /** @var PaymentMethodInterface $paymentMethod */
        $paymentMethod = $this->paymentMethodExampleFactory->create([
            'name' => ucfirst($name),
            'code' => $code,
            'description' => $description,
            'gatewayName' => $factoryName,
            'gatewayFactory' => $factoryName,
            'enabled' => true,
            'channels' => ($addForCurrentChannel && $this->sharedStorage->has('channel')) ? [$this->sharedStorage->get('channel')] : [],
        ]);
        if (null !== $position) {
            $paymentMethod->setPosition($position);
        }
        $this->sharedStorage->set('payment_method', $paymentMethod);
        $this->paymentMethodRepository->add($paymentMethod);
        return $paymentMethod;
    }
}