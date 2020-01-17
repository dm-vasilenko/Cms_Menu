<?php

namespace Web4Pro\Menu\Api\Model\Schema;

interface LinksAndCmsPageSchemaInterface
{
    const TABLE_NAME = 'web4pro_links_and_cms_page';
    const LINK_ID_COL_NAME = 'link_id';
    const PRIMARY_COL_NAME = 'cms_page_id';
    const CMS_PAGE_TABLE_NAME = 'cms_page';
    const CMS_PAGE_ORIG_COL_NAME = 'page_id';
}
