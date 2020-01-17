<?php

namespace Web4Pro\Menu\Block\Adminhtml\Example\Edit\Page;

use Magento\Framework\Registry;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_coreRegistry = null;

    protected $_productFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Cms\Model\PageFactory $productFactory,
        Registry $coreRegistry,
        array $data = []
    ) {
        $this->_productFactory = $productFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('page_grid');
        $this->setDefaultSort('page_id');
        $this->setUseAjax(true);
    }

    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'page_id') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('page_id', ['in' => $productIds]);
            } else {
                if ($productIds) {
                    $this->getCollection()->addFieldToFilter('page_id', ['nin' => $productIds]);
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    protected function _prepareCollection()
    {
        $collection = $this->_productFactory->create()->getCollection()->addFieldToSelect(
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
                'html_name' => 'page_id',
                'values' => $this->_getSelectedProducts(),
                'align' => 'center',
                'index' => 'page_id',
                'header_css_class' => 'col-select col-massaction',
                'column_css_class' => 'col-select col-massaction'
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
                'header_css_class' => 'col-title',
                'column_css_class' => 'col-title'
            ]
        );

        $this->addColumn(
            'identifier',
            [
                'header' => __('identifier'),
                'index' => 'identifier',
                'header_css_class' => 'col-identifier',
                'column_css_class' => 'col-identifier'
            ]
        );

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl(
            'cms_menu/index/productgrid',
            ['_current' => true]
        );
    }

    protected function _getSelectedProducts()
    {
        $data = $this->getRequest()->getPost('selected_products');
        return  $data;
    }

}
