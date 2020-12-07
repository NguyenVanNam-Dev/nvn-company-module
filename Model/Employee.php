<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Model;

use Magento\Framework\Api\DataObjectHelper;
use Nvn\Company\Api\Data\EmployeeInterface;
use Nvn\Company\Api\Data\EmployeeInterfaceFactory;

class Employee extends \Magento\Framework\Model\AbstractModel
{

    const ENTITY = 'nvn_employee';
    protected $employeeDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'nvn_employee';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param EmployeeInterfaceFactory $employeeDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Nvn\Company\Model\ResourceModel\Employee $resource
     * @param \Nvn\Company\Model\ResourceModel\Employee\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        EmployeeInterfaceFactory $employeeDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Nvn\Company\Model\ResourceModel\Employee $resource,
        \Nvn\Company\Model\ResourceModel\Employee\Collection $resourceCollection,
        array $data = []
    ) {
        $this->employeeDataFactory = $employeeDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve employee model with employee data
     * @return EmployeeInterface
     */
    public function getDataModel()
    {
        $employeeData = $this->getData();
        
        $employeeDataObject = $this->employeeDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $employeeDataObject,
            $employeeData,
            EmployeeInterface::class
        );
        
        return $employeeDataObject;
    }

    protected function _construct()
    {
        $this->_init('Nvn\Company\Model\ResourceModel\Employee');
    }
}

