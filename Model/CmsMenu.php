<?php

namespace Web4Pro\Menu\Model;

use Magento\Framework\Model\AbstractModel;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu as ResourceModel;

class CmsMenu extends AbstractModel
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }


}
