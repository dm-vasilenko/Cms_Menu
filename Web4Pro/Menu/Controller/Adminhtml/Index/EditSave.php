<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;
use Web4Pro\Menu\Model\CmsMenuFactory;

class EditSave extends CmsMenu
{
    protected $resultPageFactory;
    protected $model;

    public function __construct(Context $context, PageFactory $pageFactory, CmsMenuFactory $modelFactory)
    {
        parent::__construct($context, $pageFactory);
        $this->model = $modelFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                $id = $data['link_id'];

                $contact = $this->model->create()->load($id);

                $data = array_filter($data, function ($value) {
                    return $value !== '';
                });

                $contact->setData($data);
                $contact->save();
                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/listingpage');
            } catch (\Exception $d) {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $contact->getId()]);
            }
        }

        return $resultRedirect->setPath('*/*/listingpage');
    }
}
