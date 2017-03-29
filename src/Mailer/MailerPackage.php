<?php
namespace ObjectivePHP\Package\Mailer;

use Fei\ApiClient\Transport\BasicTransport;
use Fei\Service\Mailer\Client\Mailer;
use ObjectivePHP\Application\ApplicationInterface;
use ObjectivePHP\Package\Mailer\Config\MailerParam;

/**
 * Class MailerPackage
 *
 * @package ObjectivePHP\Package\Mailer
 */
class MailerPackage
{
    /**
     * Invoke magic method
     *
     * @param ApplicationInterface $app
     */
    public function __invoke(ApplicationInterface $app)
    {
        $app->getServicesFactory()->registerService(
            [
                'id' =>'mailer.client',
                'class' => Mailer::class,
                'params' => [
                    $app->getConfig()->get(MailerParam::class),
                ],
                'setters' => [
                    'setTransport' => new BasicTransport()
                ]
            ]
        );
    }
}
