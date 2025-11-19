<?php
/**
 * Copyright © Priyank Jivani All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Controller\Adminhtml;

abstract class Testimonials extends \Magento\Backend\App\Action
{
    /**
     * Core registry instance
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * ACL resource
     */
    public const ADMIN_RESOURCE = 'Priyank_Testimonials::top_level';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Priyank'), __('Priyank'))
            ->addBreadcrumb(__('Testimonials'), __('Testimonials'));
        return $resultPage;
    }
}
