<?php

namespace Web4Pro\Menu\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Web4Pro\Menu\Model\CmsMenuFactory;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu as ResourceModel;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu\Collection;

abstract class CmsMenu extends Action
{
    const ADMIN_RESOURCE = 'Web4Pro_Menu::cms_menu';
    const PAGE_TITLE = 'Links';

    protected $pageFactory;

    protected $modelFactory;

    protected $resourceModel;

    protected $collection;

    protected $logger;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CmsMenuFactory $model,
        ResourceModel $resourceModel,
        Collection $collection,
        LoggerInterface $logger
    ) {
        $this->pageFactory = $pageFactory;
        $this->modelFactory = $model;
        $this->resourceModel = $resourceModel;
        $this->collection = $collection;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }

    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/index');
    }
}
