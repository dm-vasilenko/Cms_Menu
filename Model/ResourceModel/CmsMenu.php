<?php

namespace Web4Pro\Menu\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Web4Pro\Menu\Api\Model\Schema\LinksSchemaInterface;

class CmsMenu extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(LinksSchemaInterface::TABLE_NAME, LinksSchemaInterface::LINK_ID_COL_NAME);
    }

    public function afterSave(\Magento\Framework\DataObject $object)
    {
        $table = $this->getConnection()->getTableName('web4pro_links_and_cms_page');
        $query = "INSERT INTO {$table} (link_id, cms_page_id) VALUES ( {$object->getId()}, {$object->getCms_page_link()} ) ";
        $this->getConnection()->query($query);
        parent::afterSave($object);
    }

    public function afterEditSave(\Magento\Framework\DataObject $object)
    {
        $table = $this->getConnection()->getTableName('web4pro_links_and_cms_page');
        $query = "UPDATE  {$table} SET cms_page_id = {$object->getSelected_pages()}";

        if (is_array($object['selected_pages'])) {
            $pages = $object['selected_pages'];

            foreach ($pages as $page) {
                $query = "UPDATE  {$table} SET cms_page_id = {$page}";
                $this->getConnection()->query($query);
            }
        }
        $this->getConnection()->query($query);

        parent::afterSave($object);
    }
}
