<?php
namespace Fei\Service\Mailer\Package;

use Fei\ApiClient\Transport\BasicTransport;
use Fei\ApiClient\Transport\BeanstalkProxyTransport;
use Fei\Service\Mailer\Client\Mailer;
use Fei\Service\Mailer\Package\Config\MailerAsyncTransport;
use Fei\Service\Mailer\Package\Config\MailerParam;
use Fei\Service\Mailer\Package\Config\MailerTransportOptions;
use ObjectivePHP\Application\ApplicationInterface;
use Pheanstalk\Pheanstalk;
use Pheanstalk\PheanstalkInterface;

/**
 * Class MailerPackage
 *
 * @package ObjectivePHP\Package\Mailer
 */
class MailerPackage
{
    protected $identifier = 'mailer.client';

    /**
     * Construct the service with a specific name
     *
     * MailerPackage constructor
     *
     * @param string $serviceIdentifier
     */
    public function __construct(string $serviceIdentifier = 'filer.client')
    {
        $this->identifier = $serviceIdentifier;
    }

    /**
     * Invoke magic method
     *
     * @param ApplicationInterface $app
     */
    public function __invoke(ApplicationInterface $app)
    {
        $config = $app->getConfig();

        $options = ($config->has(MailerTransportOptions::class)) ? $config->get(MailerTransportOptions::class) : [];
        $options = (is_array($options)) ? $options : [];

        $setters = [
            'setTransport' => [new BasicTransport($options)]
        ];

        // if a config for the async transport is set, we use it
        if ($config->has(MailerAsyncTransport::class)) {
            $asyncConfig = $config->get(MailerAsyncTransport::class);
            if (isset($asyncConfig['host'])) {
                $proxy = new BeanstalkProxyTransport();
                $proxy->setPheanstalk(
                    new Pheanstalk($asyncConfig['host'], $asyncConfig['port'] ?? PheanstalkInterface::DEFAULT_PORT)
                );
                $setters['setAsyncTransport'] = [$proxy];
            }
        }

        $app->getServicesFactory()->registerService(
            [
                'id' => $this->identifier,
                'class' => Mailer::class,
                'params' => [
                    $app->getConfig()->get(MailerParam::class),
                ],
                'setters' => $setters
            ]
        );
    }
}
