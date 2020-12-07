<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Model;

use Magento\Framework\Api\DataObjectHelper;
use Nvn\Company\Api\Data\DepartmentInterface;
use Nvn\Company\Api\Data\DepartmentInterfaceFactory;

class Department extends \Magento\Framework\Model\AbstractModel
{

    protected $departmentDataFactory;
    protected $dataObjectHelper;
    protected $_eventPrefix = 'nvn_company_department';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param DepartmentInterfaceFactory $departmentDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Nvn\Company\Model\ResourceModel\Department $resource
     * @param \Nvn\Company\Model\ResourceModel\Department\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        DepartmentInterfaceFactory $departmentDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Nvn\Company\Model\ResourceModel\Department $resource,
        \Nvn\Company\Model\ResourceModel\Department\Collection $resourceCollection,
        array $data = []
    ) {
        $this->departmentDataFactory = $departmentDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this-> _init('Nvn\Company\Model\ResourceModel\Department');
    }

    /**
     * Retrieve department model with department data
     * @return DepartmentInterface
     */
    public function getDataModel()
    {
        $departmentData = $this->getData();

        $departmentDataObject = $this->departmentDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $departmentDataObject,
            $departmentData,
            DepartmentInterface::class
        );

        return $departmentDataObject;
    }
}

