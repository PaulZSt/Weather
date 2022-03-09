<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Api\Data;

/**
 * Interface WeatherInterface
 * @package Elogic\WeatherInfo\Api\Data
 */
interface WeatherInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const WEATHER = 'weather';
    const CREATED_AT = 'created_at';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Weather
     *
     * @return string
     */
    public function getWeather();
    
    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt();
    
    /**
     * Set ID
     *
     * @return WeatherInterface
     */
    public function setId($id);

    /**
     * Set Weather
     *
     * @param $updatedAt
     * @return WeatherInterface
     */
    public function setWeather($weather);

    /**
     * Set Created At
     *
     * @param $createdAt
     * @return WeatherInterface
     */
    public function setCreatedAt($createdAt);
}
