<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;

class Delete extends CmsMenu
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $model = $this->modelFactory->create();
            $model->load($id);
            $model->delete();
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Link not deleted');
        }
        $this->redirectToGrid();
    }
}
