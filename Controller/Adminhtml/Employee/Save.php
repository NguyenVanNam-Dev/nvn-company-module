<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Controller\Adminhtml\Employee;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    /**
     * @var \Nvn\Company\Model\EmployeeFactory
     */
    private $employeeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Nvn\Company\Model\EmployeeFactory $employeeFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Nvn\Company\Model\EmployeeFactory $employeeFactory
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->employeeFactory = $employeeFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }

        $id = $this->getRequest()->getParam('entity_id');
        $model = $this->employeeFactory->create()->load($id);
        if (!$model->getId() && $id) {
            $this->messageManager->addErrorMessage(__('This Employee no longer exists.'));
            return $resultRedirect->setPath('*/*/');
        }
        $model->setData($data);
        $model->setDepartmentId(1);

        try {
            $model->save();
            $this->messageManager->addSuccessMessage(__('You saved the Employee.'));
            $this->dataPersistor->clear('nvn_company_employee');

            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getId()]);
            }
            return $resultRedirect->setPath('*/*/');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Employee.'));
        }

        $this->dataPersistor->set('nvn_company_employee', $data);
        return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
    }
}

