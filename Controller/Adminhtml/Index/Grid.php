<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Grid extends Action
{
    protected $resultRawFactory;

    protected $layoutFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory
    ) {
        parent::__construct($context);
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
    }

    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents(
            $this->layoutFactory->create()->createBlock(
                \Web4pro\Menu\Block\Adminhtml\Example\Edit\Page\Grid::class,
                'pages_grid'
            )->toHtml()
        );
    }
}
