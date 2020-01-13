<?php

namespace Web4Pro\Menu\Api\Model\Schema;

interface CmsMenuSchemaInterface
{
    const TABLE_NAME = 'web4pro_links';
    const LINK_ID_COL_NAME = 'link_id';
    const LINK_NAME_COL_NAME = 'link_name';
    const CMS_PAGE_LINK = 'cms_page_link';
    const IS_ENABLED = 'is_enabled';
    const CREATED_AT_COL_NAME = 'created_at';

    const LINKS_TABLE_NAME = 'web4pro_links';
    const CMS_PAGE_TABLE_NAME = 'cms_page';
    const CMS_PAGE_ORIG_COL_NAME = 'page_id';
}
