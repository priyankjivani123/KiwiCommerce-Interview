<?php
namespace Priyank\Testimonials\Controller\Adminhtml\Testimonials;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Priyank\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory;

class MassStatus extends Action
{
    /**
     * Mass action filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * Testimonials collection factory
     *
     * @var CollectionFactory
     */
    protected $collectionFactory;

   /**
    * Constructor
    *
    * @param Context           $context
    * @param Filter            $filter
    * @param CollectionFactory $collectionFactory
    */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Execute mass status update action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $status = (int) $this->getRequest()->getParam('status');
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();

            foreach ($collection as $testimonial) {
                $testimonial->setStatus($status);
                $testimonial->save();
            }

            $statusLabel = $status ? 'enabled' : 'disabled';
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been %2.', $collectionSize, $statusLabel)
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
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
