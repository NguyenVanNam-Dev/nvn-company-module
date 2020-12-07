<?php

namespace Nvn\Company\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface {

    protected $departmentFactory;
    protected $employeeFactory;

    public function __construct(
    \Nvn\Company\Model\DepartmentFactory $departmentFactory,
    \Nvn\Company\Model\EmployeeFactory $employeeFactory
    ) {
        $this->departmentFactory = $departmentFactory;
        $this->employeeFactory = $employeeFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
            $setup->startSetup();
            /* #snippet1 */
            $salesDepartment = $this->departmentFactory->create();
            $salesDepartment->setDepartmentName	('Sales2');
            $salesDepartment->save();
            $employee = $this->employeeFactory->create();
            $employee->setDepartmentId($salesDepartment->getId());
            $employee->setEmployeeName("Nguyen Van Nam");
            $employee->setEmail('john@sales.loc');
            $employee->setEmployeeSalary(3800.00);
            $employee->setEmployeeBirdthday('1983-03-28');
            $employee->setEmployeeAge(22);
            $employee->save();
            $setup->endSetup();
    }
}
