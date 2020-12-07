<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Nvn\Company\Setup\EmployeeSetup;
use Nvn\Company\Setup\EmployeeSetupFactory;

class DefaultEmployeeEntity implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EmployeeSetup
     */
    private $employeeSetupFactory;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EmployeeSetupFactory $employeeSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EmployeeSetupFactory $employeeSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->employeeSetupFactory = $employeeSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var EmployeeSetup $customerSetup */
        $employeeSetup = $this->employeeSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $employeeSetup->installEntities();
        

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
        
        ];
    }
}

