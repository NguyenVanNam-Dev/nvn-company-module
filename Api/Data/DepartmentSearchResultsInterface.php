<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Api\Data;

interface DepartmentSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get department list.
     * @return \Nvn\Company\Api\Data\DepartmentInterface[]
     */
    public function getItems();

    /**
     * Set department_name list.
     * @param \Nvn\Company\Api\Data\DepartmentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

