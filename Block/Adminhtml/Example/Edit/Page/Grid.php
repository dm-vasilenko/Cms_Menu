<?php

namespace Web4Pro\Menu\Block\Adminhtml\Example\Edit\Page;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\Registry;
use Web4Pro\Menu\Model\CmsMenuFactory;

class Grid extends Extended
{
    protected $coreRegistry = null;

    protected $pageFactory;

    protected $linkFactory;

    public function __construct(
        Context $context,
        Data $backendHelper,
        PageFactory $pageFactory,
        CmsMenuFactory $linkFactory,
        Registry $coreRegistry,
        array $data = []
    ) {
        $this->linkFactory = $linkFactory;
        $this->pageFactory = $pageFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('page_grid');
        $this->setDefaultSort('page_id');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'page_id') {
            $pageIds = $this->getSelectedPages();
            if (empty($pageIds)) {
                $pageIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('page_id', ['in' => $pageIds]);
            } else {
                if ($pageIds) {
                    $this->getCollection()->addFieldToFilter('page_id', ['nin' => $pageIds]);
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    protected function _prepareCollection()
    {
        $collection = $this->pageFactory->create()->getCollection()->addFieldToSelect(
            '*'
        );
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'page_id',
            [
                'type' => 'checkbox',
                'editable'     => true,
                'edit_only'    => false,
                'html_name' => 'page_id',
                'values' => $this->getSelectedPages(),
                'align' => 'center',
                'index' => 'page_id',
                'field_name' =>'selected_pages',
                'header_css_class' => 'col-select col-massaction',
                'column_css_class' => 'col-select col-massaction'
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
                'sortable' => true,
                'header_css_class' => 'col-title',
                'column_css_class' => 'col-title'
            ]
        );

        $this->addColumn(
            'page_layout',
            [
                'header' => __('Page layout'),
                'index' => 'page_layout',
                'sortable' => true,
                'header_css_class' => 'col-title',
                'column_css_class' => 'col-title'
            ]
        );

        $this->addColumn(
            'identifier',
            [
                'header' => __('Identifier'),
                'index' => 'identifier',
                'sortable' => true,
                'header_css_class' => 'col-identifier',
                'column_css_class' => 'col-identifier'
            ]
        );

        $this->addColumn(
            'creation_time',
            [
                'header' => __('Creation time'),
                'index' => 'creation_time',
                'sortable' => true,
                'header_css_class' => 'col-identifier',
                'column_css_class' => 'col-identifier'
            ]
        );

        $this->addColumn(
            'update_time',
            [
                'header' => __('Update time'),
                'index' => 'update_time',
                'sortable' => true,
                'header_css_class' => 'col-identifier',
                'column_css_class' => 'col-identifier'
            ]
        );

        $this->addColumn(
            'is_active',
            [
                'header' => __('is active'),
                'index' => 'is_active',
                'sortable' => true,
                'header_css_class' => 'col-identifier',
                'column_css_class' => 'col-identifier'
            ]
        );

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl(
            '*/*/grid',
            ['_current' => true]
        );
    }

    public function getSelectedPages()
    {
        if ($this->getRequest()->getParam('id') == null) {
            return null;
        } else {
            return $this->getPagesCollection();
        }
    }

    protected function getPagesCollection()
    {
        return $this->linkFactory->create()->getResource()->getCheckedPages($this->getRequest()->getParam('id'));
    }
}
