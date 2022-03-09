<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 *
 * @package Elogic\WeatherInfo\Config
 */
class Config
{

    const XML_PATH_WEATRHERINFO_ENABLE = 'weatherinfo/general/enable';
    const XML_PATH_WEATRHERINFO_API_URL = 'weatherinfo/general/api_url';
    const XML_PATH_WEATRHERINFO_CITY_CODE = 'weatherinfo/general/city_code';
    const XML_PATH_WEATRHERINFO_DEBUG= 'weatherinfo/debug/debug';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Config XML path
     *
     * @param $path
     * @param null $scopeCode
     * @return mixed
     */
    public function getConfig($path, $scopeCode = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $scopeCode);
    }

    /**
     * Is enabled
     *
     * @param null $scopeCode
     * @return bool
     */
    public function isEnabled($scopeCode = null)
    {
        return (bool)$this->getConfig(self::XML_PATH_WEATRHERINFO_ENABLE, $scopeCode);
    }

    /**
     * Is debug enabled
     *
     * @param null $storeId
     * @return bool
     */
    public function isDebug($scopeCode = null)
    {
        return (bool)$this->getConfig(self::XML_PATH_WEATRHERINFO_DEBUG, $scopeCode);
    }

    /**
     * Get API URL
     *
     * @param null $scopeCode
     * @return string
     */
    public function getApiUrl($scopeCode = null)
    {
        return $this->getConfig(self::XML_PATH_WEATRHERINFO_API_URL, $scopeCode);
    }
    
    /**
     * Get City Code
     *
     * @param null $scopeCode
     * @return string
     */
    public function getCityCode($scopeCode = null)
    {
        return $this->getConfig(self::XML_PATH_WEATRHERINFO_CITY_CODE, $scopeCode);
    }

}
