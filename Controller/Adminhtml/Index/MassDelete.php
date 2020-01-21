<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;

class MassDelete extends CmsMenu
{
    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');

        if (count($ids)) {
            foreach ($ids as $id) {
                try {
                    $model = $this->modelFactory->create();
                    $model->load($id);
                    $model->delete();
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                    $this->logger->critical(
                        sprintf("Can\'t delete link: %d", $id)
                    );
                    $this->messageManager->addErrorMessage(__('Link with id %1 not deleted', $id));
                }
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) has been deleted.', count($ids))
            );
        } else {
            $this->logger->error("Parameter ids must be array and not empty");
            $this->messageManager->addWarningMessage("Please select items to delete");
            $this->redirectToGrid();
        }

        return $this->redirectToGrid();
    }
}
