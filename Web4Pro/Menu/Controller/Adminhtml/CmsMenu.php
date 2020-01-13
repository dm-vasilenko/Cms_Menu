<?php

namespace Web4Pro\Menu\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

abstract class CmsMenu extends Action
{
    const ADMIN_RESOURCE = 'Web4Pro_Menu::cms_menu';
    const PAGE_TITLE = 'Links';

    protected $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
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
        return $this->_redirect('*/*/listing');
    }

}
