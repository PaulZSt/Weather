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
    public function save(WeatherInterface $weather);

    /**
     * @param $weatherId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($weatherId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param Data\WeatherInterface $weather
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(WeatherInterface $weather);

    /**
     * @param $weatherId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($weatherId);
}
