<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Model\ResourceModel\Department;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'department_id';

    /**
     * Define resource model
     *
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Nvn\Company\Model\Department::class,
            \Nvn\Company\Model\ResourceModel\Department::class
        );
    }
}

