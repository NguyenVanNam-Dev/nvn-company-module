<?php

namespace Nvn\Company\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $employeeEnity  = \Nvn\Company\Model\Employee::ENTITY;
        /* #snippet1 */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('nvn_company_department'))
            ->addColumn(
                'department_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Department Id'
            )
            ->addColumn('department_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 64, ['default' => ''], 'Department Name')
            ->setComment('NVN Company Department Table');
        $setup->getConnection()->createTable($table);


        /* #snipet2 */
        /* nvn_employee_enity */
        $table = $setup->getConnection()
            ->newTable($setup->getTable($employeeEnity . '_entity'))
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'employee_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                [],
                'Employee Name'
            )->addColumn(
                'department_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Department Id'
            )->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                [],
                'Email'
            )->addForeignKey(
                $setup->getFkName(
                    $employeeEnity  . '_entity',
                    'department_id',
                    'nvn_company_department',
                    'department_id'
                ),
                'department_id',
                $setup->getTable('nvn_company_department'),
                'department_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment('Employee Table');
            $setup->getConnection()->createTable($table);

        /* nvn_employee_enity_int */
        $table = $setup->getConnection()
            ->newTable($setup->getTable($employeeEnity  . '_entity_int'))
            ->addColumn(
                'value_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Value ID'
            )
            ->addColumn(
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Attribute ID'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store ID'
            )
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Entity ID'
            )
            ->addColumn(
                'value',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [],
                'Value'
            )
            ->addIndex(
                $setup->getIdxName(
                    $employeeEnity  . '_entity_int',
                    ['entity_id', 'attribute_id', 'store_id'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['entity_id', 'attribute_id', 'store_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_int', ['attribute_id']),
                ['attribute_id']
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_int', ['store_id']),
                ['store_id']
            )
            ->addForeignKey(
                $setup->getFkName($employeeEnity  . '_entity_int', 'attribute_id', 'eav_attribute', 'attribute_id'),
                'attribute_id',
                $setup->getTable('eav_attribute'),
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($employeeEnity  . '_entity_int', 'entity_id', $employeeEnity  . '_entity', 'entity_id'),
                'entity_id',
                $setup->getTable($employeeEnity  . '_entity'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($employeeEnity  . '_entity_int', 'store_id', 'store', 'store_id'),
                'store_id',
                $setup->getTable('store'),
                'store_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Nvn Employee Integer Attribute Table');

        $setup->getConnection()->createTable($table);

        /* nvn_employee_enity_datetime */
        $table = $setup->getConnection()
            ->newTable($setup->getTable($employeeEnity  . '_entity_datetime'))
            ->addColumn(
                'value_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Value ID'
            )
            ->addColumn(
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Attribute ID'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store ID'
            )
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Entity ID'
            )
            ->addColumn(
                'value',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                null,
                [],
                'Value'
            )
            ->addIndex(
                $setup->getIdxName(
                    $employeeEnity  . '_entity_datetime',
                    ['entity_id', 'attribute_id', 'store_id'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['entity_id', 'attribute_id', 'store_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_datetime', ['attribute_id']),
                ['attribute_id']
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_datetime', ['store_id']),
                ['store_id']
            )
            ->addForeignKey(
                $setup->getFkName(
                    $employeeEnity  . '_entity_datetime',
                    'attribute_id',
                    'eav_attribute',
                    'attribute_id'
                ),
                'attribute_id',
                $setup->getTable('eav_attribute'),
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName(
                    $employeeEnity  . '_entity_datetime',
                    'entity_id',
                    $employeeEnity  . '_entity',
                    'entity_id'
                ),
                'entity_id',
                $setup->getTable($employeeEnity  . '_entity'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($employeeEnity  . '_entity_datetime', 'store_id', 'store', 'store_id'),
                'store_id',
                $setup->getTable('store'),
                'store_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Nvn Employee Datetime Attribute Table');
        $setup->getConnection()->createTable($table);

        /**/
        $table = $setup->getConnection()
            ->newTable($setup->getTable($employeeEnity . '_entity_varchar'))
            ->addColumn(
                'value_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Value ID'
            )
            ->addColumn(
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Attribute ID'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store ID'
            )
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Entity ID'
            )
            ->addColumn(
                'value',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Value'
            )
            ->addIndex(
                $setup->getIdxName(
                    $employeeEnity  . '_entity_varchar',
                    ['entity_id', 'attribute_id', 'store_id'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['entity_id', 'attribute_id', 'store_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_varchar', ['attribute_id']),
                ['attribute_id']
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_varchar', ['store_id']),
                ['store_id']
            )
            ->addForeignKey(
                $setup->getFkName(
                    $employeeEnity  . '_entity_varchar',
                    'attribute_id',
                    'eav_attribute',
                    'attribute_id'
                ),
                'attribute_id',
                $setup->getTable('eav_attribute'),
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName(
                    $employeeEnity  . '_entity_varchar',
                    'entity_id',
                    $employeeEnity  . '_entity',
                    'entity_id'
                ),
                'entity_id',
                $setup->getTable($employeeEnity  . '_entity'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($employeeEnity  . '_entity_varchar', 'store_id', 'store', 'store_id'),
                'store_id',
                $setup->getTable('store'),
                'store_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('NVN Employee Varchar Attribute Table');

        $setup->getConnection()->createTable($table);

        /* */
        $table = $setup->getConnection()
            ->newTable($setup->getTable($employeeEnity  . '_entity_text'))
            ->addColumn(
                'value_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Value ID'
            )
            ->addColumn(
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Attribute ID'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store ID'
            )
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Entity ID'
            )
            ->addColumn(
                'value',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                [],
                'Value'
            )
            ->addIndex(
                $setup->getIdxName(
                    $employeeEnity  . '_entity_text',
                    ['entity_id', 'attribute_id', 'store_id'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['entity_id', 'attribute_id', 'store_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_text', ['attribute_id']),
                ['attribute_id']
            )
            ->addIndex(
                $setup->getIdxName($employeeEnity  . '_entity_text', ['store_id']),
                ['store_id']
            )
            ->addForeignKey(
                $setup->getFkName(
                    $employeeEnity  . '_entity_text',
                    'attribute_id',
                    'eav_attribute',
                    'attribute_id'
                ),
                'attribute_id',
                $setup->getTable('eav_attribute'),
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName(
                    $employeeEnity  . '_entity_text',
                    'entity_id',
                    $employeeEnity  . '_entity',
                    'entity_id'
                ),
                'entity_id',
                $setup->getTable($employeeEnity  . '_entity'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($employeeEnity  . '_entity_text', 'store_id', 'store', 'store_id'),
                'store_id',
                $setup->getTable('store'),
                'store_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Bss Banner Text Attribute Table');
        $setup->getConnection()->createTable($table);

        /* decimal */
        $table = $setup->getConnection()
        ->newTable($setup->getTable($employeeEnity . '_entity_decimal'))
        ->addColumn(
            'value_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Value ID'
        )
        ->addColumn(
            'attribute_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Attribute ID'
        )
        ->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Store ID'
        )
        ->addColumn(
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Entity ID'
        )
        ->addColumn(
            'value',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            [],
            'Value'
        )
        ->addIndex(
            $setup->getIdxName(
                $employeeEnity . '_entity_decimal',
                ['entity_id', 'attribute_id', 'store_id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['entity_id', 'attribute_id', 'store_id'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )
        ->addIndex(
            $setup->getIdxName($employeeEnity . '_entity_decimal', ['store_id']),
            ['store_id']
        )
        ->addIndex(
            $setup->getIdxName($employeeEnity . '_entity_decimal', ['attribute_id']),
            ['attribute_id']
        )
        ->addForeignKey(
            $setup->getFkName(
                $employeeEnity . '_entity_decimal',
                'attribute_id',
                'eav_attribute',
                'attribute_id'
            ),
            'attribute_id',
            $setup->getTable('eav_attribute'),
            'attribute_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
        ->addForeignKey(
            $setup->getFkName(
                $employeeEnity . '_entity_decimal',
                'entity_id',
                $employeeEnity . '_entity',
                'entity_id'
            ),
            'entity_id',
            $setup->getTable($employeeEnity . '_entity'),
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
        ->addForeignKey(
            $setup->getFkName($employeeEnity . '_entity_decimal', 'store_id', 'store', 'store_id'),
            'store_id',
            $setup->getTable('store'),
            'store_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
        ->setComment('NVN Employee Decimal Attribute Table');

    $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
