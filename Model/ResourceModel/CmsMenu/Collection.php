<?php

namespace Web4Pro\Menu\Model\ResourceModel\CmsMenu;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu as ResourceModel;
use Web4Pro\Menu\Model\CmsMenu as Model;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'link_id';

    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
