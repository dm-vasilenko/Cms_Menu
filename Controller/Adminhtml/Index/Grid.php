<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RawFactory;

class Grid extends Action
{
    protected $resultRawFactory;

    public function __construct(
        Action\Context $context,
        RawFactory $resultRawFactory
    ) {
        parent::__construct($context);
        $this->resultRawFactory = $resultRawFactory;
    }

    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents(
            $this->_view->getLayout()->createBlock(
                \Web4Pro\Menu\Block\Adminhtml\Example\Edit\Page\Grid::class,
                'link.pages.grid'
            )->toHtml()
        );
    }
}
