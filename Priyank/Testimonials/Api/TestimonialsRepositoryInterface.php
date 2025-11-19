<?php
/**
 * Copyright © Priyank Jivani All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Priyank\Testimonials\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TestimonialsRepositoryInterface
{
    /**
     * Save Testimonials.
     *
     * @param \Priyank\Testimonials\Api\Data\TestimonialsInterface $testimonials
     *
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Priyank\Testimonials\Api\Data\TestimonialsInterface $testimonials
    );

    /**
     * Retrieve Testimonials.
     *
     * @param string $testimonialsId
     *
     * @return \Priyank\Testimonials\Api\Data\TestimonialsInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($testimonialsId);

    /**
     * Retrieve Testimonials matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Priyank\Testimonials\Api\Data\TestimonialsSearchResultsInterface
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Testimonials.
     *
     * @param \Priyank\Testimonials\Api\Data\TestimonialsInterface $testimonials
     *
     * @return bool true on success
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Priyank\Testimonials\Api\Data\TestimonialsInterface $testimonials
    );

    /**
     * Delete Testimonials by ID.
     *
     * @param string $testimonialsId
     *
     * @return bool true on success
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($testimonialsId);
}
