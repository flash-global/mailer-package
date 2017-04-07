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
use Fei\Service\Mailer\Package\MailerPackage

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

The name of the service will be mailer.client. If you want to rename it, you can plug the package like this:

```
        // Plugging the Mailer Package in the bootstrap step
        $this->getStep('bootstrap')
        ->plug(new MailerPackage('my-service'));
```
### Application configuration

Create a file in your configuration directory and put your Mailer configuration as below:

```php
<?php
use Fei\Service\Mailer\Package\Config\MailerParam;
use Fei\Service\Mailer\Client\Mailer;
use Fei\Service\Mailer\Package\Config\MailerAsyncTransport;
use Fei\Service\Mailer\Package\Config\MailerTransportOptions;

return [
    new MailerParam([Mailer::OPTION_BASEURL => 'http://mailer.dev:8181']),
    new MailerAsyncTransport('127.0.0.1'),
    new MailerTransportOptions([]),
];
```

In the previous example you need to set this configuration:

* `MailerParam` : represent the URL where the API can be contacted in order to send the mails
* `MailerAsyncTransport` : if this config is set, the client will try to use the async transport instead of the BasicTransport
* `MailerTransportOptions` : represents the options for the transport of the request if you want to set specific options

Please check out `mailer-client` documentation for more information about how to use this client.