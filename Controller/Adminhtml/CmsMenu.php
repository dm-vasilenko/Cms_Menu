<?php

namespace Web4Pro\Menu\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Web4Pro\Menu\Model\CmsMenuFactory;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;


abstract class CmsMenu extends Action
{
    const ADMIN_RESOURCE = 'Web4Pro_Menu::link';
    const PAGE_TITLE = 'Links';

    protected $pageFactory;

    protected $filter;

    protected $modelFactory;

    protected $collectionFactory;

    protected $logger;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CmsMenuFactory $model,
        CollectionFactory $collectionFactory,
        LoggerInterface $logger,
        Filter $filter
    ) {
        $this->pageFactory = $pageFactory;
        $this->modelFactory = $model;
        $this->collectionFactory = $collectionFactory;
        $this->logger = $logger;
        $this->filter = $filter;
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
