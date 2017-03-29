# Mailer Package

This package provide Mailer Client integration for Objective PHP applications.

## Installation

Mailer Package needs **PHP 7.0** or up to run correctly.

You will have to integrate it to your Objective PHP project with `composer require fei/mailer-package`.


## Integration

As shown below, the Mailer Package must be plugged in the application initialization method.

The Mailer Package create a Mailer Client service that will be consumed by the application's middlewares.

```php
<?php

use ObjectivePHP\Application\AbstractApplication;
use ObjectivePHP\Package\Mailer\MailerPackage;

class Application extends AbstractApplication
{
    public function init()
    {
        // Define some application steps
        $this->addSteps('bootstrap', 'init', 'auth', 'route', 'rendering');
        
        // Initializations...

        // Plugging the Mailer Package in the bootstrap step
        $this->getStep('bootstrap')
        ->plug(MailerPackage::class);

        // Another initializations...
    }
}
```
### Application configuration

Create a file in your configuration directory and put your Mailer configuration as below:

```php
<?php
use ObjectivePHP\Package\Mailer\Config\MailerParam;
use Fei\Service\Mailer\Client\Mailer;

return [
    new MailerParam([Mailer::OPTION_BASEURL => 'http://mailer.dev:8181']),
];
```

In the previous example you need to set this configuration:

* `MailerParam` : represent the URL where the API can be contacted in order to send the mails

Please check out `mailer-client` documentation for more information about how to use this client.