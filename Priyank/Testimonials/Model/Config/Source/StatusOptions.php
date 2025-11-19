<?php
namespace Priyank\Testimonials\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Status options for testimonials enable/disable dropdown.
 */
class StatusOptions implements OptionSourceInterface
{
    /**
     * Return array of status options.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Enabled')],
            ['value' => 0, 'label' => __('Disabled')],
        ];
    }
}
