<?php
/**
 * Copyright © Priyank Jivani All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Controller\Adminhtml\Testimonials;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * JSON result factory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);

            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelId) {

                    /** @var \Priyank\Testimonials\Model\Testimonials $model */
                    $model = $this->_objectManager
                        ->create(\Priyank\Testimonials\Model\Testimonials::class)
                        ->load($modelId);

                    try {
                        // Instead of array_merge() inside loop
                        $model->addData($postItems[$modelId]);
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = sprintf(
                            '[Testimonials ID: %s] %s',
                            $modelId,
                            $e->getMessage()
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error'    => $error
        ]);
    }

    /**
     * Check ACL permission
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Priyank_Testimonials::Testimonials_update');
    }
}
