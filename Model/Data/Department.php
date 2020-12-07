<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Model\Data;

use Nvn\Company\Api\Data\DepartmentInterface;

class Department extends \Magento\Framework\Api\AbstractExtensibleObject implements DepartmentInterface
{

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId()
    {
        return $this->_get(self::DEPARTMENT_ID);
    }

    /**
     * Set department_id
     * @param string $departmentId
     * @return \Nvn\Company\Api\Data\DepartmentInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
    }

    /**
     * Get department_name
     * @return string|null
     */
    public function getDepartmentName()
    {
        return $this->_get(self::DEPARTMENT_NAME);
    }

    /**
     * Set department_name
     * @param string $departmentName
     * @return \Nvn\Company\Api\Data\DepartmentInterface
     */
    public function setDepartmentName($departmentName)
    {
        return $this->setData(self::DEPARTMENT_NAME, $departmentName);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Nvn\Company\Api\Data\DepartmentExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Nvn\Company\Api\Data\DepartmentExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Nvn\Company\Api\Data\DepartmentExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

