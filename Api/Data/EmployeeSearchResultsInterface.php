<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nvn\Company\Api\Data;

interface EmployeeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get employee list.
     * @return \Nvn\Company\Api\Data\EmployeeInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \Nvn\Company\Api\Data\EmployeeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

