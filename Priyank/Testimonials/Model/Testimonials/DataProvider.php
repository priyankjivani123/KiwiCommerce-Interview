<?php
/**
 * Copyright © Priyank Jivani
 * All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Model\Testimonials;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Priyank\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class DataProvider extends AbstractDataProvider
{
    /**
     * Loaded data cache
     *
     * @var array
     */
    protected $loadedData = [];

    /**
     * Testimonials collection
     *
     * @var \Priyank\Testimonials\Model\ResourceModel\Testimonials\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManager
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Retrieve and prepare data for the UI form.
     *
     * This method loads testimonial items, processes image data,
     * applies persisted form data, and returns the final dataset
     * required by the UI component.
     *
     * @inheritdoc
     */
    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $model) {
            $id = $model->getId();
            $this->loadedData[$id] = $model->getData();

            if ($model->getProfilePic()) {
                $this->loadedData[$id]['profile_pic'] = [
                    [
                        'name' => $model->getProfilePic(),
                        'url'  => $this->getMediaUrl($model->getProfilePic())
                    ]
                ];
            }
        }

        $data = $this->dataPersistor->get('priyank_testimonials_testimonials');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('priyank_testimonials_testimonials');
        }

        return $this->loadedData;
    }

    /**
     * Get full media URL for profile image
     *
     * @param string $path
     * @return string
     */
    public function getMediaUrl($path = '')
    {
        $mediaBaseUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        return $mediaBaseUrl . 'wysiwyg/helloworld/' . $path;
    }
}
