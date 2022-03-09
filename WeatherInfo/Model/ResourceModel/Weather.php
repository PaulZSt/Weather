<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Weather
 * @package Elogic\WeatherInfo\Model\ResourceModel
 */
class Weather extends AbstractDb
{
    /**
     * Initialize ResourceModel
     *
     * @return void
     */
    public function _construct() {
        $this->_init('elogic_weather_info','id');
    }

}
