<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Nvn\Company\Api\Data\EmployeeInterfaceFactory;
use Nvn\Company\Api\Data\EmployeeSearchResultsInterfaceFactory;
use Nvn\Company\Api\EmployeeRepositoryInterface;
use Nvn\Company\Model\ResourceModel\Employee as ResourceEmployee;
use Nvn\Company\Model\ResourceModel\Employee\CollectionFactory as EmployeeCollectionFactory;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    protected $resource;

    protected $employeeFactory;

    protected $employeeCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataEmployeeFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceEmployee $resource
     * @param EmployeeFactory $employeeFactory
     * @param EmployeeInterfaceFactory $dataEmployeeFactory
     * @param EmployeeCollectionFactory $employeeCollectionFactory
     * @param EmployeeSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceEmployee $resource,
        EmployeeFactory $employeeFactory,
        EmployeeInterfaceFactory $dataEmployeeFactory,
        EmployeeCollectionFactory $employeeCollectionFactory,
        EmployeeSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->employeeFactory = $employeeFactory;
        $this->employeeCollectionFactory = $employeeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataEmployeeFactory = $dataEmployeeFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Nvn\Company\Api\Data\EmployeeInterface $employee
    ) {
        /* if (empty($employee->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $employee->setStoreId($storeId);
        } */
        
        $employeeData = $this->extensibleDataObjectConverter->toNestedArray(
            $employee,
            [],
            \Nvn\Company\Api\Data\EmployeeInterface::class
        );
        
        $employeeModel = $this->employeeFactory->create()->setData($employeeData);
        
        try {
            $this->resource->save($employeeModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the employee: %1',
                $exception->getMessage()
            ));
        }
        return $employeeModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($employeeId)
    {
        $employee = $this->employeeFactory->create();
        $this->resource->load($employee, $employeeId);
        if (!$employee->getId()) {
            throw new NoSuchEntityException(__('employee with id "%1" does not exist.', $employeeId));
        }
        return $employee->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->employeeCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Nvn\Company\Api\Data\EmployeeInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Nvn\Company\Api\Data\EmployeeInterface $employee
    ) {
        try {
            $employeeModel = $this->employeeFactory->create();
            $this->resource->load($employeeModel, $employee->getEntityId());
            $this->resource->delete($employeeModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the employee: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($employeeId)
    {
        return $this->delete($this->get($employeeId));
    }
}

