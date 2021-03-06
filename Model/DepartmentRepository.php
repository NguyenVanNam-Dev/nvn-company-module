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
use Nvn\Company\Api\Data\DepartmentInterfaceFactory;
use Nvn\Company\Api\Data\DepartmentSearchResultsInterfaceFactory;
use Nvn\Company\Api\DepartmentRepositoryInterface;
use Nvn\Company\Model\ResourceModel\Department as ResourceDepartment;
use Nvn\Company\Model\ResourceModel\Department\CollectionFactory as DepartmentCollectionFactory;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    protected $resource;

    protected $departmentFactory;

    protected $departmentCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataDepartmentFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceDepartment $resource
     * @param DepartmentFactory $departmentFactory
     * @param DepartmentInterfaceFactory $dataDepartmentFactory
     * @param DepartmentCollectionFactory $departmentCollectionFactory
     * @param DepartmentSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceDepartment $resource,
        DepartmentFactory $departmentFactory,
        DepartmentInterfaceFactory $dataDepartmentFactory,
        DepartmentCollectionFactory $departmentCollectionFactory,
        DepartmentSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->departmentFactory = $departmentFactory;
        $this->departmentCollectionFactory = $departmentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataDepartmentFactory = $dataDepartmentFactory;
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
        \Nvn\Company\Api\Data\DepartmentInterface $department
    ) {
        /* if (empty($department->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $department->setStoreId($storeId);
        } */
        
        $departmentData = $this->extensibleDataObjectConverter->toNestedArray(
            $department,
            [],
            \Nvn\Company\Api\Data\DepartmentInterface::class
        );
        
        $departmentModel = $this->departmentFactory->create()->setData($departmentData);
        
        try {
            $this->resource->save($departmentModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the department: %1',
                $exception->getMessage()
            ));
        }
        return $departmentModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($departmentId)
    {
        $department = $this->departmentFactory->create();
        $this->resource->load($department, $departmentId);
        if (!$department->getId()) {
            throw new NoSuchEntityException(__('department with id "%1" does not exist.', $departmentId));
        }
        return $department->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->departmentCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Nvn\Company\Api\Data\DepartmentInterface::class
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
        \Nvn\Company\Api\Data\DepartmentInterface $department
    ) {
        try {
            $departmentModel = $this->departmentFactory->create();
            $this->resource->load($departmentModel, $department->getDepartmentId());
            $this->resource->delete($departmentModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the department: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($departmentId)
    {
        return $this->delete($this->get($departmentId));
    }
}

