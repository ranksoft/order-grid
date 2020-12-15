<?php
declare(strict_types = 1);

namespace RANK\OrderGrid\Model\ResourceModel\Order\Grid;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as OriginalCollection;

class Collection extends OriginalCollection
{
    protected function _renderFiltersBefore(): void
    {
        $this->getSelect()->joinLeft('sales_order', 'main_table.entity_id = sales_order.entity_id', ['coupon_code', 'discount_amount']);
        parent::_renderFiltersBefore();
    }
}
