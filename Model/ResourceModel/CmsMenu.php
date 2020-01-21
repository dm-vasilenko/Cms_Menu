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

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $table = $this->getConnection()->getTableName('web4pro_links_and_cms_page');
        $pages = $object['selected_pages'];
        if (empty($_POST['link_id'])) {
            foreach ($pages as $page) {
                $query = "INSERT INTO {$table} (link_id, cms_page_id) VALUES ( {$object->getId()}, {$page} )";
                $this->getConnection()->query($query);
            }
        } else {
            $beforePages = $this->getCheckedPages($object->getData('link_id'));
            $afterPages = $object->getData('selected_pages');

            if (!empty($afterPages)) {
                $pages = array_diff($afterPages, $beforePages);
                foreach ($pages as $page) {
                    $query = "INSERT INTO {$table} (link_id, cms_page_id) VALUES ( {$object->getId()}, {$page} )";
                    $this->getConnection()->query($query);
                }
            }
            if (count($beforePages) >= count($afterPages) && $afterPages !== $beforePages) {
                $pages = array_diff($beforePages, $afterPages);
                foreach ($pages as $page) {
                    $query = "DELETE FROM {$table} WHERE cms_page_id = {$page}";
                    $this->getConnection()->query($query);
                }
            }
        }
    }

    public function getCheckedPages($link_id)
    {
        $table = $this->getConnection()->getTableName('web4pro_links_and_cms_page');
        $query = "SELECT cms_page_id FROM {$table} WHERE link_id = {$link_id}";
        $pages = $this->getConnection()->query($query)->fetchAll();
        foreach ($pages as $page) {
            $data[] = $page['cms_page_id'];
        }
        return $data;
    }
}
