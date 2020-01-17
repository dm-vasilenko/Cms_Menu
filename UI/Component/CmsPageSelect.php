<?php

namespace Web4Pro\Menu\UI\Component;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;

class CmsPageSelect implements OptionSourceInterface
{
    private $pageRepositoryInterface;

    private $searchCriteriaBuilder;

    public function __construct(PageRepositoryInterface $pageRepositoryInterface, SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $searchCriteriaBuilder = $this->searchCriteriaBuilder->create();
        $items = $this->pageRepositoryInterface->getList($searchCriteriaBuilder)->getItems();
        $options = [];
        foreach ($items as $item) {
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getTitle(),
            ];
        }
        return $options;
    }
}
