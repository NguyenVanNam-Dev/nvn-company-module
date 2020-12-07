<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Model\ResourceModel;

class Employee extends \Magento\Eav\Model\Entity\AbstractEntity
{

    protected function _construct() {
        $this->_read = 'nvn_company_employee_read';
        $this->_write = 'nvn_company_employee_write';
    }
    /**
     * Define resource model
     *
     * @return void
     */
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\Nvn\Company\Model\Employee::ENTITY);
        }
        return parent::getEntityType();
    }
}

