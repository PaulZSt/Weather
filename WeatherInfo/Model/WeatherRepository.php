<?php

namespace Elogic\WeatherInfo\Model;

use Elogic\WeatherInfo\Api\Data;
use Elogic\WeatherInfo\Api\WeatherRepositoryInterface;
use Elogic\WeatherInfo\Model\ResourceModel\Weather as ResourceWeather;
use Elogic\WeatherInfo\Model\ResourceModel\Weather\Collection as WeatherCollection;
use Elogic\WeatherInfo\Api\Data\WeatherInterfaceFactory;
use Elogic\WeatherInfo\Model\ResourceModel\Weather\CollectionFactory as WeatherCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;


/**
 * Class WeatherRepository
 * @package Elogic\WeatherInfo\Model
 */
class WeatherRepository implements WeatherRepositoryInterface
{
    /**
     * @var ResourceWeather
     */
    protected $resource;

    /**
     * @var WeatherInterfaceFactory
     */
    protected $weatherInterfaceFactory;

    /**
     * @var WeatherCollectionFactory
     */
    protected $weatherCollectionFactory;

    /**
     * @var Data\WeatherSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * WeatherRepository constructor.
     * @param ResourceWeather $resource
     * @param WeatherInterfaceFactory $weatherInterfaceFactory
     * @param WeatherCollectionFactory $weatherCollectionFactory
     * @param Data\WeatherSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceWeather $resource,
        WeatherInterfaceFactory $weatherInterfaceFactory,
        WeatherCollectionFactory $weatherCollectionFactory,
        Data\WeatherSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->resource = $resource;
        $this->weatherInterfaceFactory = $weatherInterfaceFactory;
        $this->weatherCollectionFactory = $weatherCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param Data\WeatherInterface $weather
     * @return Data\WeatherInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\WeatherInterface $weather)
    {
        try {
            $this->resource->save($weather);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the weather: %1', $exception->getMessage()),
                $exception
            );
        }

        return $weather;
    }

    /**
     * @param $weatherId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($weatherId)
    {
        $weather = $this->weatherInterfaceFactory->create();
        $this->resource->load($weather, $weatherId);

        if (!$weather->getId()) {
            throw new NoSuchEntityException(__('weather with id "%1" does not exist.', $weatherId));
        }

        return $weather;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed|Data\WeatherSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->weatherCollectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param WeatherCollection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, WeatherCollection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param WeatherCollection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, WeatherCollection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param WeatherCollection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, WeatherCollection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param WeatherCollection $collection
     * @return Data\WeatherSearchResultsInterface
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, WeatherCollection $collection)
    {
        $searchResults = $this->searchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @param Data\WeatherInterface $weather
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\WeatherInterface $weather)
    {
        try {
            $this->resource->delete($weather);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the weather: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * @param $weatherId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($weatherId)
    {
        return $this->delete($this->getById($weatherId));
    }

}
