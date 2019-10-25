<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryInStorePickupAdminUi\Plugin\Sales\Block\Adminhtml\Order;

use Magento\Sales\Block\Adminhtml\Order\View;

/**
 * Process 'Ship' button considering 'Pick in Store' shipping method.
 */
class ProcessShipButtonPlugin
{
    /**
     * Remove 'Ship' button in case order shipping method is 'in_store_pickup'.
     *
     * @param View $subject
     * @param $proceed
     * @param string $buttonId
     * @param array $data
     * @param int $level
     * @param int $sortOrder
     * @param string $region
     * @return View
     */
    public function aroundAddButton(
        View $subject,
        $proceed,
        $buttonId,
        $data,
        $level = 0,
        $sortOrder = 0,
        $region = 'toolbar'
    ): View {
        if ($buttonId === 'order_ship') {
            if ($subject->getOrder()->getShippingMethod() === 'in_store_pickup') {
                return $subject;
            }
        }

        return $proceed($buttonId, $data, $level, $sortOrder, $region);
    }
}
