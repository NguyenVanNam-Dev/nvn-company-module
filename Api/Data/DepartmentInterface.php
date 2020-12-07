<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Api\Data;

interface DepartmentInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const DEPARTMENT_ID = 'department_id';
    const DEPARTMENT_NAME = 'department_name';

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId();

    /**
     * Set department_id
     * @param string $departmentId
     * @return \Nvn\Company\Api\Data\DepartmentInterface
     */
    public function setDepartmentId($departmentId);

    /**
     * Get department_name
     * @return string|null
     */
    public function getDepartmentName();

    /**
     * Set department_name
     * @param string $departmentName
     * @return \Nvn\Company\Api\Data\DepartmentInterface
     */
    public function setDepartmentName($departmentName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Nvn\Company\Api\Data\DepartmentExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Nvn\Company\Api\Data\DepartmentExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Nvn\Company\Api\Data\DepartmentExtensionInterface $extensionAttributes
    );
}

