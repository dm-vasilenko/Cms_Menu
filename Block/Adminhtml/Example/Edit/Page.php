<?php

namespace Web4Pro\Menu\Block\Adminhtml\Example\Edit;

use Magento\Backend\Block\Widget\Grid\Serializer;

class Page extends \Magento\Backend\Block\Widget\Grid\Container
{
    public function _construct()
    {
        $this->_blockGroup = 'Web4Pro_Menu';
        $this->_controller = 'Adminhtml\Example\Edit\Page';
        $this->_template = 'Web4Pro_Menu::view.phtml';
        parent::_construct();
    }

    public function _prepareLayout()
    {
        parent::_prepareLayout();
        $serialzeAr = [
            'data' => [
                'grid_block' => $this->getChildBlock('grid'),
                'callback' => 'getSelectedPages',
                'input_element_name' => 'cms_page',
                'reload_param_name' => 'cms_page'
            ]
        ];
        $serializer = $this->getLayout()->createBlock(Serializer::class, 'serializer', $serialzeAr);
        $this->setChild('serializer', $serializer);

        return $this;
    }

    public function _addNewButton()
    {

    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid') . $this->getChildHtml('serializer');
    }
}
