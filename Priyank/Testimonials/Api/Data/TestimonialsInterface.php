<?php
/**
 * Copyright © Priyank Jivani All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Api\Data;

interface TestimonialsInterface
{
    public const ID = 'id';
    public const COMPANY_NAME = 'company_name';
    public const NAME = 'name';
    public const MESSAGE = 'message';
    public const POST = 'post';
    public const PROFILE_PIC = 'profile_pic';
    public const STATUS = 'status';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get testimonial ID.
     *
     * @return string|null
     */
    public function getTestimonialsId();

    /**
     * Set testimonial ID.
     *
     * @param string $testimonialsId
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setTestimonialsId($testimonialsId);

    /**
     * Get ID.
     *
     * @return string|null
     */
    public function getId();

    /**
     * Set ID.
     *
     * @param string $id
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setId($id);

    /**
     * Get company name.
     *
     * @return string|null
     */
    public function getCompanyName();

    /**
     * Set company name.
     *
     * @param string $companyName
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setCompanyName($companyName);

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setName($name);

    /**
     * Get message.
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message.
     *
     * @param string $message
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setMessage($message);

    /**
     * Get post.
     *
     * @return string|null
     */
    public function getPost();

    /**
     * Set post.
     *
     * @param string $post
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setPost($post);

    /**
     * Get profile picture.
     *
     * @return string|null
     */
    public function getProfilePic();

    /**
     * Set profile picture.
     *
     * @param string $profilePic
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setProfilePic($profilePic);

    /**
     * Get status.
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status.
     *
     * @param string $status
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setStatus($status);

    /**
     * Get created at timestamp.
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at timestamp.
     *
     * @param string $createdAt
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at timestamp.
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated at timestamp.
     *
     * @param string $updatedAt
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setUpdatedAt($updatedAt);
}
