<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;
use Web4Pro\Menu\Model\CmsMenuFactory;

class EditPage extends CmsMenu
{
    const PAGE_TITLE = 'Edit';

//    private $model;
//
//    public function __construct(Context $context, PageFactory $pageFactory, CmsMenuFactory $modelFactory)
//    {
//        parent::__construct($context, $pageFactory);
//        $this->model = $modelFactory->create();
//    }
//
//    public function execute()
//    {
//        parent::execute();
//        $data = $this->getRequest()->getParams();
//        $this->model->setData($data);
//        $this->redirectToGrid();
//
//
//
//
//    }
}
