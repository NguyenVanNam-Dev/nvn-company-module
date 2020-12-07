<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category   BSS
 * @package    Bss_NewEntityType
 * @author     Extension Team
 * @copyright  Copyright (c) 2018-2019 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Nvn\Company\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    private $employeeSetupFactory;
    
    public function __construct(
        \Nvn\Company\Setup\EmployeeSetupFactory $employeeSetupFactory
    ) {
        $this->employeeSetupFactory = $employeeSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $employeeEnity  = \Nvn\Company\Model\Employee::ENTITY;
        $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
        $employeeSetup->installEntities();
        $employeeSetup->addAttribute(
            $employeeEnity, 'employee_age', ['type' => 'int']
        );
        $employeeSetup->addAttribute(
            $employeeEnity, 'employee_birdthday', ['type' => 'datetime']
        );
        $employeeSetup->addAttribute(
            $employeeEnity, 'employee_salary', ['type' => 'decimal']
        );

        $setup->endSetup();

    }
}
