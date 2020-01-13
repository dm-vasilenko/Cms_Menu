<?php

namespace Web4Pro\Menu\UI\Component;

use Magento\Framework\Data\OptionSourceInterface;

class CmsPageEnabledSelect implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Yes')],
            ['value' => 0, 'label' => __('No')]
        ];
    }
}
