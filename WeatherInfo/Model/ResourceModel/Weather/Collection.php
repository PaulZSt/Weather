<?php

namespace Elogic\WeatherInfo\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Elogic\WeatherInfo\Model\ResourceModel\Weather
 */
class Collection extends AbstractCollection
{
     /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
       $this->_init('Elogic\WeatherInfo\Model\Weather','Elogic\WeatherInfo\Model\ResourceModel\Weather');
    }
}
