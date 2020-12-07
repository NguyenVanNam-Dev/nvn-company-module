<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface DepartmentRepositoryInterface
{

    /**
     * Save department
     * @param \Nvn\Company\Api\Data\DepartmentInterface $department
     * @return \Nvn\Company\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Nvn\Company\Api\Data\DepartmentInterface $department
    );

    /**
     * Retrieve department
     * @param string $departmentId
     * @return \Nvn\Company\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($departmentId);

    /**
     * Retrieve department matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Nvn\Company\Api\Data\DepartmentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete department
     * @param \Nvn\Company\Api\Data\DepartmentInterface $department
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Nvn\Company\Api\Data\DepartmentInterface $department
    );

    /**
     * Delete department by ID
     * @param string $departmentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($departmentId);
}

