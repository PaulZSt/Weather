<?php

namespace Elogic\WeatherInfo\Controller\Weather;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\JsonFactory;
use Elogic\WeatherInfo\Model\WeatherFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Elogic\WeatherInfo\Model\Logger;

class Index extends Action
{

    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var WeatherFactory
     */
    private $weatherFactory;

    /**
     * @var Json
     */
    private $json;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param WeatherFactory $weatherFactory
     * @param Json $json
     * @param Logger $logger
     */
    public function __construct(
        Context        $context,
        JsonFactory    $resultJsonFactory,
        WeatherFactory $weatherFactory,
        Json           $json,
        Logger         $logger
    )
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->weatherFactory = $weatherFactory;
        $this->json = $json;
        $this->logger = $logger;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $response = [
            'error' => __('Sorry. There is a problem with weather info.')
        ];
        
        try {
            $data = $this->weatherFactory->create()->getCollection()->getLastItem()->getWeather();

            if (isset($data)) {
                $weather = $this->json->unserialize($data);

                $response = [
                    'temp' => $weather['main']['temp']
                ];
                
            } else {
                $response = [
                    'error' => __('Sorry. Waiting for data')
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        
        $message = $this->json->serialize($message);
        $resultPage = $this->resultJsonFactory->create();
        $resultPage->setHttpResponseCode(200);
        $resultPage->setData($message);
        return $resultPage;

    }
}
