<?php

namespace Elogic\WeatherInfo\Model\ResourceModel\Weather\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class Collection
 * @package Elogic\WeatherInfo\Model\ResourceModel\Weather\Grid
 */
class Collection extends SearchResult
{
    /**
     * @return $this|SearchResult|void
     */
    protected function _initSelect()
    {
        parent::_initSelect();

        return $this;
    }
}
