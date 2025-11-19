<?php
/**
 * Copyright © Priyank Jivani All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Block\Adminhtml\Testimonials\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

   /**
    * Get button data for "Save" button
    *
    * @return array
    */
    public function getButtonData()
    {
        return [
            'label' => __('Save Testimonials'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
