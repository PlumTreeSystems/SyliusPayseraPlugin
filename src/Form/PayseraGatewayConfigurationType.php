<?php
declare(strict_types=1);

namespace PTS\SyliusPayseraPlugin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

final class PayseraGatewayConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('projectid', TextType::class, [
                'label' => 'sylius.form.gateway_configuration.paysera.project_id',
                'constraints' => [
                    new NotBlank([
                        'message' => 'sylius.gateway_config.paysera.username.not_blank',
                        'groups' => 'sylius',
                    ]),
                ],
            ])
            ->add('sign_password', TextType::class, [
                'label' => 'sylius.form.gateway_configuration.paysera.sign_password',
                'constraints' => [
                    new NotBlank([
                        'message' => 'sylius.gateway_config.paysera.password.not_blank',
                        'groups' => 'sylius',
                    ]),
                ],
            ])
            ->add('test', CheckboxType::class, [
                'label' => 'sylius.form.gateway_configuration.paysera.test',
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $data['payum.http_client'] = '@sylius.payum.http_client';
            });
    }
}