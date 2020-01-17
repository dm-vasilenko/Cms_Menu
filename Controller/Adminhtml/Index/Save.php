<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Cms\Model\PageFactory as CmsPageFactory;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;
use Web4Pro\Menu\Model\CmsMenuFactory;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu as ResourceModel;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu\Collection;

class Save extends CmsMenu
{
    protected $cmsPageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CmsMenuFactory $model,
        ResourceModel $resourceModel,
        Collection $collection,
        LoggerInterface $logger,
        CmsPageFactory $cmsPageFactory
    ) {
        parent::__construct($context, $pageFactory, $model, $resourceModel, $collection, $logger);
        $this->cmsPageFactory = $cmsPageFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $data['cms_page_url'] =  $this->cmsPageFactory->create()->load($data['cms_page_link'])->getIdentifier();
        $model = $this->modelFactory->create();

        $model->setData($data);
        try {
            if (empty($data['link_id'])) {
                $model->save();
                $model->getResource()->afterSave($model);
            } else {
                $model->save();
                $model->getResource()->afterEditSave($model);
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Link not saved');
            $this->redirectToGrid();
        }
        $this->redirectToGrid();
    }
}
