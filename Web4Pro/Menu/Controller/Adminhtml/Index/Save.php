<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;
use Web4Pro\Menu\Model\CmsMenuFactory as modelFactory;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu as resourceModel;

class Save extends CmsMenu
{
    protected $modelFactory;

    protected $resourceModel;

    protected $logger;

    private $connection;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        modelFactory $modelFactory,
        resourceModel $resourceModel,
        LoggerInterface $logger
    ) {
        parent::__construct($context, $pageFactory);
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        $this->logger = $logger;
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->modelFactory->create();

        $model->setLink_name($data['link_name']);
        $model->setCms_page_link($data['cms_page_link']);
        if ($data['is_enabled'] !== '') {
            $model->setIs_enabled($data['is_enabled']);
        }
        try {
            $this->resourceModel->save($model);
            $this->resourceModel->afterSave($model);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__("QuickOrder not saved"));
        }
        $this->redirectToGrid();
    }

}
