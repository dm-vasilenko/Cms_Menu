<?php

namespace Web4Pro\Menu\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

use Web4Pro\Menu\Api\Model\Schema\CmsMenuSchemaInterface;
use Web4Pro\Menu\Api\Model\Schema\LinksAndCmsPageSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
        $this->createLinkTable($installer);
        $this->createLinkAndCmsPageTable($installer);
        $setup->getConnection()->addForeignKey(
            $setup->getFkName(
                $setup->getTable(LinksAndCmsPageSchemaInterface::TABLE_NAME),
                LinksAndCmsPageSchemaInterface::CMS_PAGE_COL_NAME,
                $setup->getTable(LinksAndCmsPageSchemaInterface::CMS_PAGE_TABLE_NAME),
                LinksAndCmsPageSchemaInterface::CMS_PAGE_ORIG_COL_NAME
            ),
            $setup->getTable(LinksAndCmsPageSchemaInterface::TABLE_NAME),
            LinksAndCmsPageSchemaInterface::CMS_PAGE_COL_NAME,
            $setup->getTable(LinksAndCmsPageSchemaInterface::CMS_PAGE_TABLE_NAME),
            LinksAndCmsPageSchemaInterface::CMS_PAGE_ORIG_COL_NAME,
            \Magento\Framework\DB\Ddl\Table::ACTION_NO_ACTION
        );
        $setup->getConnection()->addForeignKey(
            $setup->getFkName(
                $setup->getTable(LinksAndCmsPageSchemaInterface::TABLE_NAME),
                LinksAndCmsPageSchemaInterface::LINK_ID_COL_NAME,
                $setup->getTable(CmsMenuSchemaInterface::TABLE_NAME),
                CmsMenuSchemaInterface::LINK_ID_COL_NAME
            ),
            $setup->getTable(LinksAndCmsPageSchemaInterface::TABLE_NAME),
            LinksAndCmsPageSchemaInterface::LINK_ID_COL_NAME,
            $setup->getTable(CmsMenuSchemaInterface::TABLE_NAME),
            CmsMenuSchemaInterface::LINK_ID_COL_NAME,
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        );
        $installer->endSetup();
    }

    public function createLinkTable($installer)
    {
        if (!$installer->tableExists(CmsMenuSchemaInterface::TABLE_NAME)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable(CmsMenuSchemaInterface::TABLE_NAME)
            )
                ->addColumn(
                    CmsMenuSchemaInterface::LINK_ID_COL_NAME,
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Link ID'
                )->addColumn(
                    CmsMenuSchemaInterface::LINK_NAME_COL_NAME,
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    32,
                    [
                        'nullable' => false,
                    ],
                    'Link name'
                )->addColumn(
                    CmsMenuSchemaInterface::CMS_PAGE_LINK,
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    120,
                    [
                        'nullable' => false,
                    ],
                    'Is enabled'
                )->addColumn(
                    CmsMenuSchemaInterface::IS_ENABLED,
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                        'default' => 1
                    ],
                    'Is enabled'
                )->addColumn(
                    CmsMenuSchemaInterface::CREATED_AT_COL_NAME,
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Date of Create'
                )->setComment('Reference table');
            $installer->getConnection()->createTable($table);
        }
    }

    public function createLinkAndCmsPageTable($installer)
    {
        if (!$installer->tableExists(LinksAndCmsPageSchemaInterface::TABLE_NAME)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable(LinksAndCmsPageSchemaInterface::TABLE_NAME)
            )
                ->addColumn(
                    LinksAndCmsPageSchemaInterface::LINK_ID_COL_NAME,
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                        'primary'  => true
                    ],
                    'Link ID'
                )->addColumn(
                    LinksAndCmsPageSchemaInterface::CMS_PAGE_COL_NAME,
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Cms page ID'
                )->setComment('Cms_page and web4pro_cms_menu table relationships table');

            $installer->getConnection()->createTable($table);
        }
    }
}
