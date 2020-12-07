<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Controller\Adminhtml\Employee;

class Index extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;
    /**
     * @var \Nvn\Company\Model\EmployeeFactory
     */
    private $employeeFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Nvn\Company\Model\EmployeeFactory $employeeFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Nvn\Company\Model\EmployeeFactory $employeeFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->employeeFactory = $employeeFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $collection = $this->employeeFactory->create()->getCollection();
        $collection->addAttributeToSelect('*');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("employee"));
        return $resultPage;
    }
}

