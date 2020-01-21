<?php

namespace Web4Pro\Menu\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Cms\Model\PageFactory as CmsPageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Web4Pro\Menu\Controller\Adminhtml\CmsMenu;
use Web4Pro\Menu\Model\CmsMenuFactory;
use Web4Pro\Menu\Model\ResourceModel\CmsMenu\Collection;

class Save extends CmsMenu
{
    protected $cmsPageFactory;

    protected $resultRedirect;


    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CmsMenuFactory $model,
        Collection $collection,
        LoggerInterface $logger,
        CmsPageFactory $cmsPageFactory,
        ResultFactory $result
    ) {
        parent::__construct($context, $pageFactory, $model, $collection, $logger);
        $this->resultRedirect = $result;
        $this->cmsPageFactory = $cmsPageFactory;
    }

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

            $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }
        return $this->redirectToGrid();
    }
}
