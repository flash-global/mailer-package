<?php
namespace Fei\Service\Mailer\Package\Config;

use ObjectivePHP\Config\SingleValueDirective;

class MailerTransportOptions extends SingleValueDirective
{
    public function __construct(array $value = [])
    {
        parent::__construct($value);
    }

    /**
     * Set the options for the basic transport
     *
     * @param array $options
     *
     * @return MailerTransportOptions
     */
    public function setOptions(array $options) : MailerTransportOptions
    {
        $this->value = $options;

        return $this;
    }
}
