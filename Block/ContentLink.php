<?php

namespace Web4Pro\Menu\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Web4Pro\Menu\Api\Model\Schema\LinksAndCmsPageSchemaInterface;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu\CollectionFactory;

class ContentLink extends Template
{
    protected $linkCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $linkCollectionFactory,
        array $data = []
    ) {
        $this->linkCollectionFactory = $linkCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getLink()
    {
        $pageId = $this->getLayout()->getBlock("cms_page")->getPage()->getId();
        $linkCollection = $this->linkCollectionFactory->create();
        $joinTable = LinksAndCmsPageSchemaInterface::TABLE_NAME;
        $linkCollection
            ->join($joinTable, "main_table.link_id = $joinTable.link_id", 'cms_page_id')
            ->addFieldToFilter('cms_page_id', $pageId)
            ->addFieldToFilter('is_enabled', 1);
        return $linkCollection;
    }
}
