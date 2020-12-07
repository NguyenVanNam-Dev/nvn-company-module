<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Controller\Adminhtml\Department;

class Edit extends \Nvn\Company\Controller\Adminhtml\Department
{

    protected $resultPageFactory;
    /**
     * @var \Nvn\Company\Model\DepartmentFactory
     */
    private $departmentFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Nvn\Company\Model\DepartmentFactory $departmentFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Nvn\Company\Model\DepartmentFactory $departmentFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->departmentFactory = $departmentFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('department_id');
        $model = $this->departmentFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Department no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('nvn_company_department', $model);

        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Department') : __('New Department'),
            $id ? __('Edit Department') : __('New Department')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Departments'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Department %1', $model->getId()) : __('New Department'));
        return $resultPage;
    }
}

