<?php

namespace Web4Pro\Menu\Api\Model\Schema;

interface LinksSchemaInterface
{
    const TABLE_NAME = 'web4pro_links';

    const LINK_ID_COL_NAME = 'link_id';
    const LINK_NAME_COL_NAME = 'link_name';
    const LINK_BODY_COL_NAME = 'link_body';
    const IS_ENABLED = 'is_enabled';
    const CREATED_AT_COL_NAME = 'created_at';
}
