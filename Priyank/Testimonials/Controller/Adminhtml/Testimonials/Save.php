<?php
/**
 * Copyright © Priyank Jivani All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Controller\Adminhtml\Testimonials;

use Magento\Framework\Exception\LocalizedException;
use Priyank\Testimonials\Model\ImageUploader;

class Save extends \Magento\Backend\App\Action
{
    /**
     * Data persistor instance
     *
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Image upload handler instance.
     *
     * @var \Priyank\Testimonials\Model\ImageUploader
     */
    protected $imageUploaderModel;

    /**
     * Constructor for admin testimonials save action.
     *
     * @param \Magento\Backend\App\Action\Context                   $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param ImageUploader                                         $imageUploaderModel
     */

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploaderModel
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->imageUploaderModel = $imageUploaderModel;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data           = $this->getRequest()->getPostValue();

        if ($data) {
            $id    = $this->getRequest()->getParam('id');
            $model = $this->_objectManager->create(
                \Priyank\Testimonials\Model\Testimonials::class
            )->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Testimonials no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model = $this->imageData($model, $data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Testimonials.'));
                $this->dataPersistor->clear('priyank_testimonials_testimonials');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        ['id' => $model->getId()]
                    );
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the Testimonials.')
                );
            }

            $this->dataPersistor->set('priyank_testimonials_testimonials', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process image data and prepare before save
     *
     * @param \Priyank\Testimonials\Model\Testimonials $model
     * @param array                                    $data
     *
     * @return \Priyank\Testimonials\Model\Testimonials
     */
    public function imageData($model, $data)
    {
        if ($model->getId()) {
            $model = $this->_objectManager->create(
                \Priyank\Testimonials\Model\Testimonials::class
            )->load($model->getId());

            if (isset($data['profile_pic'][0]['name'])) {
                $oldImage = $model->getThumbnail();
                $newImage = $data['profile_pic'][0]['name'];

                if ($oldImage !== $newImage) {
                    $imageUrl  = $data['profile_pic'][0]['url'];
                    $imageName = $data['profile_pic'][0]['name'];

                    $data['profile_pic'] = $this->imageUploaderModel
                        ->saveMediaImage($imageName, $imageUrl);
                } else {
                    $data['profile_pic'] = $data['profile_pic'][0]['name'];
                }
            } else {
                $data['profile_pic'] = '';
            }
        } else {
            if (isset($data['profile_pic'][0]['name'])) {
                $imageUrl  = $data['profile_pic'][0]['url'];
                $imageName = $data['profile_pic'][0]['name'];

                $data['profile_pic'] = $this->imageUploaderModel->saveMediaImage(
                    $imageName,
                    $imageUrl
                );
            }
        }

        $model->setData($data);
        return $model;
    }

    /**
     * Check ACL permission
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization
            ->isAllowed('Priyank_Testimonials::Testimonials_save');
    }
}
