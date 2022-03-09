<?php
declare(strict_types=1);

namespace Elogic\WeatherInfo\Model;

use Psr\Log\LoggerInterface;
use Elogic\WeatherInfo\Config\Config;

class Logger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param LoggerInterface $logger
     * @param Config $config
     */
    public function __construct(
        LoggerInterface $logger,
        Config $config
    )
    {
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * @param $data
     * @return void
     */
    public function debugData($data): void
    {
        if ($this->config->isDebug()) {
            if (is_string($data)) {
                $this->logger->debug($data);
            } else {
                $this->logger->debug(print_r($data, true));
            }
        }
    }

}
