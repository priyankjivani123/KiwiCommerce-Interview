<?php
/**
 * Copyright © Priyank Jivani All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Model;

use Magento\Framework\Model\AbstractModel;
use Priyank\Testimonials\Api\Data\TestimonialsInterface;

class Testimonials extends AbstractModel implements TestimonialsInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Priyank\Testimonials\Model\ResourceModel\Testimonials::class);
    }

    /**
     * @inheritDoc
     */
    public function getTestimonialsId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setTestimonialsId($testimonialsId)
    {
        return $this->setData(self::ID, $testimonialsId);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getCompanyName()
    {
        return $this->getData(self::COMPANY_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setCompanyName($companyName)
    {
        return $this->setData(self::COMPANY_NAME, $companyName);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * @inheritDoc
     */
    public function getPost()
    {
        return $this->getData(self::POST);
    }

    /**
     * @inheritDoc
     */
    public function setPost($post)
    {
        return $this->setData(self::POST, $post);
    }

    /**
     * @inheritDoc
     */
    public function getProfilePic()
    {
        return $this->getData(self::PROFILE_PIC);
    }

    /**
     * @inheritDoc
     */
    public function setProfilePic($profilePic)
    {
        return $this->setData(self::PROFILE_PIC, $profilePic);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
