<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Api;

/**
 * Interface ApiInterface
 * @package Elogic\WeatherInfo\Api
 */
interface WeatherApiInterface
{
    public function getWeather();
}
