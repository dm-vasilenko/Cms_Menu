<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;

class MassDelete extends CmsMenu
{
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            try {
                $item->delete();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Link with id %1 not deleted', $item->getId()));
            }
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        $this->redirectToGrid();
    }
}
