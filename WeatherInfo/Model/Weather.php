<?php

namespace Elogic\WeatherInfo\Model;

use Magento\Framework\Model\AbstractModel;
use Elogic\WeatherInfo\Api\Data\WeatherInterface;

/**
 * Class Weather
 * @package Elogic\WeatherInfo\Model
 */
class Weather extends AbstractModel implements WeatherInterface
{

    /**
     * Intitialize model
     */
    public function _construct()
    {
        $this->_init('Elogic\WeatherInfo\Model\ResourceModel\Weather');
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getData(WeatherInterface::ID);
    }
    
    /**
     * @inheritdoc
     */
    public function getWeather()
    {
        return $this->getData(WeatherInterface::WEATHER);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        return $this->getData(WeatherInterface::CREATED_AT);
    }
    
    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->setData(WeatherInterface::ID, $id);

        return $this;
    }


    /**
     * @inheritdoc
     */
    public function setWeather($weather)
    {
        $this->setData(WeatherInterface::WEATHER, $weather);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(WeatherInterface::CREATED_AT, $createdAt);

        return $this;
    }

}
