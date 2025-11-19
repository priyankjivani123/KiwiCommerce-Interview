<?php
namespace Priyank\Testimonials\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Priyank\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Testimonials extends Template
{
    /**
     * Testimonials collection factory
     *
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Store manager instance
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Constructor
     *
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * Get approved testimonials collection
     *
     * @return \Priyank\Testimonials\Model\ResourceModel\Testimonials\Collection
     */
    public function getTestimonials()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('status', 1)
                   ->setOrder('created_at', 'DESC');
        return $collection;
    }

    /**
     * Get media URL for profile pictures
     *
     * @return string
     */
    public function getMediaUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * Get profile picture URL
     *
     * @param string|null $profilePic
     * @return string
     */
    public function getProfilePicUrl($profilePic)
    {
        if ($profilePic) {
            return $this->getMediaUrl() . 'wysiwyg/helloworld/' . $profilePic;
        }
        return $this->getViewFileUrl('Priyank_Testimonials::images/default-avatar.png');
    }
}
