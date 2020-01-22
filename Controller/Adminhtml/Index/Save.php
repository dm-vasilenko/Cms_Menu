<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;

class Save extends CmsMenu
{
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if (!empty($data['selected_pages'])) {
            $data['selected_pages'] = explode('&', $data['selected_pages']);
        }
        $model = $this->modelFactory->create();

        $model->setData($data);
        try {
            if (empty($data['selected_pages'])) {
                throw new \Exception('You must definitely select at least one page');
            }
            $model->save();

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Unfortunately the link was not saved');

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }
        return $this->redirectToGrid();
    }
}
