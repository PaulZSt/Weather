<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Elogic\WeatherInfo\Api\Data\WeatherInterface;

/**
 * Interface WeatherRepositoryInterface
 * @package Elogic\WeatherInfo\Api
 */
interface WeatherRepositoryInterface
{
    /**
     * @param Data\WeatherInterface $weather
     * @return Data\WeatherInterface
     * @throws CouldNotSaveException
     */
    public function save(WeatherInterface $weather): WeatherInterface;

    /**
     * @param $weatherId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById(int $weatherId): WeatherInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchCriteriaInterface;

    /**
     * @param WeatherInterface $weather
     * @return WeatherInterface
     */
    public function delete(WeatherInterface $weather): WeatherInterface;

    /**
     * @param $weatherId
     * @return WeatherInterface
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $weatherId): WeatherInterface;
}
