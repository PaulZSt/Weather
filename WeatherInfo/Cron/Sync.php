<?php

namespace Elogic\WeatherInfo\Cron;

use Elogic\WeatherInfo\Config\Config;
use Elogic\WeatherInfo\Service\Weather\WeatherApi;
use Elogic\WeatherInfo\Model\WeatherFactory;
use Elogic\WeatherInfo\Api\WeatherRepositoryInterface;
use Elogic\WeatherInfo\Model\Logger;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class Sync
 * @package Elogic\WeatherInfo\Cron
 */
class Sync
{
    
    /**
     * @var
     */
    private $logger;

    /**
     * @var Config
     */
    private $config;
    
    /**
     * @var Json
     */
    private $json;

    /**
     * @param Config $config
     * @param Logger $logger
     * @param Api $Api
     * @param WeatherFactory $weatherFactory
     * @param WeatherRepositoryInterface $weatherRepository
     * @param Json $json
     */
    public function __construct(
        Config $config,
        Logger $logger,
        WeatherApi $weatherApi,
        WeatherFactory $weatherFactory,
        WeatherRepositoryInterface $weatherRepository,
        Json $json
    )
    {
        $this->config = $config;
        $this->logger = $logger;
        $this->weatherApi = $weatherApi;
        $this->weatherFactory = $weatherFactory;
        $this->weatherRepository = $weatherRepository;
        $this->json = $json;

    }

    /**
     * Execute
     */
    public function execute()
    {
        if (!$this->config->isEnabled()) {
            return false;
        }
        try {
            $data = $this->weatherApi->getWeather();
            $weather = $this->weatherFactory->create();
            $weather->setData([
                'weather' => $this->json->serialize($data)
            ]);
            $this->weatherRepository->save($weather);
            
        } catch (\Exception $e) {
            $message = sprintf('Weather cron exception: %s', $e->getMessage());
            $this->logger->debugData($message);
            
        }

        return true;
    }
}
