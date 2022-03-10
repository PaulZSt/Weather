<?php
declare(strict_types=1);

namespace Elogic\WeatherInfo\Service\Weather;

use Magento\Framework\Serialize\Serializer\Json;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use Magento\Framework\Webapi\Rest\Request;
use Elogic\WeatherInfo\Api\WeatherApiInterface;
use Elogic\WeatherInfo\Model\Logger;
use Elogic\WeatherInfo\Config\Config;

class WeatherApi implements WeatherApiInterface
{
    /**
     * Request without city code
     */
    const API_REQUEST = 'data/2.5/weather?q=%s&units=metric&appid=%s';

    /**
     * Status success
     */
    const SUCCESS_STATUS_CODE = 200;

    /**
     * @var Json
     */
    private $jsonSerializer;

    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param ClientFactory $clientFactory
     * @param Json $jsonSerializer
     * @param Logger $logger
     * @param Config $config
     */
    public function __construct(
        ClientFactory $clientFactory,
        Json $jsonSerializer,
        Logger $logger,
        Config $config
    ) {
        $this->clientFactory = $clientFactory;
        $this->jsonSerializer = $jsonSerializer;
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getWeather(): array
    {
        try {
            $request = $this->config->getApiUrl().sprintf(
                self::API_REQUEST,
                $this->config->getCityCode(),
                $this->config->getApiKey()
            );
            $response = $this->doRequest(
                $request,
                [],
                Request::HTTP_METHOD_GET
            );
            $status = $response->getStatusCode();
            if ($status == self::SUCCESS_STATUS_CODE) {
                $data = $responseBody = $response->getBody()->getContents();
                $message = sprintf('API data: %s', $data);

                $this->logger->debugData($message);

                return $this->jsonSerializer->unserialize($data);

            }
        } catch (GuzzleException | \Exception $e) {
            $message = sprintf('API request error: %s', $e->getMessage());
            $this->logger->debugData($message);
            return [];

        }

        return [];
    }

    /**
     * @param $uriEndpoint
     * @param $params
     * @param $requestMethod
     * @return mixed
     */
    private function doRequest(string $uriEndpoint, array $params = [], string $method)
    {
        $client = $this->clientFactory->create(
            ['config' =>
                [
                    'base_uri' => $this->config->getApiUrl()
                ]
            ]
        );
        try {
            $response = $client->request(
                $method,
                $uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]); $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

            $message = sprintf('API request error: %s', $response);

            $this->logger->debugData($message);

        }

        return $response;
    }
}
