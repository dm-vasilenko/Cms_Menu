<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;

class Edit extends CmsMenu
{
    const PAGE_TITLE = 'Edit Link';

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');


        return parent::execute();
    }
}
