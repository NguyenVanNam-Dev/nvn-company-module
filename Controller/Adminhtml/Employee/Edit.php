<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Controller\Adminhtml\Employee;

class Edit extends \Nvn\Company\Controller\Adminhtml\Employee
{

    protected $resultPageFactory;
    /**
     * @var \Nvn\Company\Model\EmployeeFactory
     */
    private $employeeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Nvn\Company\Model\EmployeeFactory $employeeFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Nvn\Company\Model\EmployeeFactory $employeeFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->employeeFactory = $employeeFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $model = $this->employeeFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Employee no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('nvn_company_employee', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Employee') : __('New Employee'),
            $id ? __('Edit Employee') : __('New Employee')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Employees'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Employee %1', $model->getId()) : __('New Employee'));
        return $resultPage;
    }
}

