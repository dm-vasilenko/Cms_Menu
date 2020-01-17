<?php

namespace Web4Pro\Menu\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Web4Pro\Menu\Api\Model\Schema\CmsMenuSchemaInterface;

class CmsMenu extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(CmsMenuSchemaInterface::TABLE_NAME, CmsMenuSchemaInterface::LINK_ID_COL_NAME);
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
        $query = "UPDATE  {$table} SET cms_page_id = {$object->getCms_page_link()}";
        $this->getConnection()->query($query);
        parent::afterSave($object);
    }
}
