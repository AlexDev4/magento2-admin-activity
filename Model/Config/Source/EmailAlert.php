<?php

namespace Catgento\AdminActivity\Model\Config\Source;

class EmailAlert implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            '0' => 'Disabled',
            '1' => 'Report Monthly',
            '2' => 'Report Weekly',
            '3' => 'Report Daily',
            '4' => 'Report Immediatly'
        ];
    }
}
