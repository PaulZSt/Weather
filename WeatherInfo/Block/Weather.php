<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Interface WeatherRepositoryInterface
 * @package Elogic\WeatherInfo\Block\Weather
 */
class Weather extends Template
{
    /**
     * @var Json 
     */
    private $jsonHelper;

    /**
     * @param Template\Context $context
     * @param Json $jsonHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Json $jsonHelper,
        array $data = []
    ) {
        $this->jsonHelper = $jsonHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getJsLayout(): string
    {
        return $this->jsonHelper->serialize($this->jsLayout);
    }
}
