<?php
namespace Fei\Service\Mailer\Package\Config;

use ObjectivePHP\Config\SingleValueDirective;
use Pheanstalk\PheanstalkInterface;

/**
 * Class MailerAsyncTransport
 *
 * @package Fei\Service\Mailer\Package\Config
 */
class MailerAsyncTransport extends SingleValueDirective
{
    public function __construct(string $host = '127.0.0.1', int $port = PheanstalkInterface::DEFAULT_PORT)
    {
        parent::__construct([
            'host' => $host,
            'port' => $port
        ]);
    }

    /**
     * Set the host of the async transport
     *
     * @param string $host
     *
     * @return MailerAsyncTransport
     */
    public function setHost(string $host) : MailerAsyncTransport
    {
        $this->value['host'] = $host;

        return $this;
    }

    /**
     * Set the port of the async transport
     *
     * @param integer $port
     *
     * @return MailerAsyncTransport
     */
    public function setPort(int $port) : MailerAsyncTransport
    {
        $this->value['port'] = $port;

        return $this;
    }
}
