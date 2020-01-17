<?php

namespace Web4Pro\Menu\Model\ResourceModel\CmsMenu\Grid;

use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu as ResourceModel;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu\Collection as CmsMenuCollection;

class Collection extends CmsMenuCollection implements SearchResultInterface
{
    /** @var AggregationInterface */
    protected $aggregations;

    /** @var SearchCriteriaInterface */
    protected $searchCriteria;

    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(Document::class, ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /** {@inheritdoc} */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /** {@inheritdoc} */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /** {@inheritdoc} */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        $this->searchCriteria = $searchCriteria;

        return $this;
    }

    /** {@inheritdoc} */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /** {@inheritdoc} */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /** {@inheritdoc} */
    public function setItems(array $items = null)
    {
        return $this;
    }

    /** {@inheritdoc} */
    public function getItems()
    {
        return $this;
    }
}
