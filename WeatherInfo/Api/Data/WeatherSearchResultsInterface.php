<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface WeatherSearchResultsInterface
 * @package Elogic\WeatherInfo\Api\Data
 */
interface WeatherSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get weather list.
     *
     * @return \Elogic\WeatherInfo\Api\Data\WeatherInterface[]
     */
    public function getItems();

    /**
     * Set weather list.
     *
     * @param \Elogic\WeatherInfo\Api\Data\WeatherInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
