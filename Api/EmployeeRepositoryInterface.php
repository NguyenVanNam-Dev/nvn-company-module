<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface EmployeeRepositoryInterface
{

    /**
     * Save employee
     * @param \Nvn\Company\Api\Data\EmployeeInterface $employee
     * @return \Nvn\Company\Api\Data\EmployeeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Nvn\Company\Api\Data\EmployeeInterface $employee
    );

    /**
     * Retrieve employee
     * @param string $entityId
     * @return \Nvn\Company\Api\Data\EmployeeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($entityId);

    /**
     * Retrieve employee matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Nvn\Company\Api\Data\EmployeeSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete employee
     * @param \Nvn\Company\Api\Data\EmployeeInterface $employee
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Nvn\Company\Api\Data\EmployeeInterface $employee
    );

    /**
     * Delete employee by ID
     * @param string $entityId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($entityId);
}

