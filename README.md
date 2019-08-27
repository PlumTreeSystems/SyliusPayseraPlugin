# Sylius Paysera Plugin ![travis](https://api.travis-ci.org/PlumTreeSystems/SyliusPayseraPlugin.svg?branch=master "Travis") [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PlumTreeSystems/SyliusPayseraPlugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PlumTreeSystems/SyliusPayseraPlugin/?branch=master)

This is a Sylius plugin for integrating paysera payments with `PlumTreeSystems/PayumPayseraGateway`

## Installation

Run `composer require plumtreesystems/sylius-paysera-plugin`.

Add plugin dependencies to your bundles.php file:

```php
return [
    PTS\SyliusPayseraPlugin\PTSSyliusPayseraPlugin::class => ['all' => true],
];
```
Clear your project cache to enable translations:

`php bin/console cache:clear`

## Usage

Add your project configuration from inside the admin panel

For test payments, check the "Test mode" option

Override your SyliusShopBundle templates to insert paysera logo to your shop

### Credits

This package uses Paysera's library for integrating payments with Paysera

https://bitbucket.org/paysera/libwebtopay/

