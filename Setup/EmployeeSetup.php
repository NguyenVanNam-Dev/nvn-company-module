<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Setup;

use Magento\Eav\Setup\EavSetup;

class EmployeeSetup extends EavSetup
{

    public function getDefaultEntities()
    {
        return [
             \Nvn\Company\Model\Employee::ENTITY => [
                'entity_model' => \Nvn\Company\Model\ResourceModel\Employee::class,
                'table' => 'nvn_employee_entity',
                'attributes' => [
                    'employee_name' => [
                        'type' => 'static'
                    ],
                    'department_id' => [
                        'type' => 'static'
                    ],
                    'email' => [
                        'type' => 'static'
                    ]
                ]
            ]
        ];
    }
}

