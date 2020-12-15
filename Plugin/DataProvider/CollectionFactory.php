<?php
declare(strict_types = 1);

namespace RANK\OrderGrid\Plugin\DataProvider;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection;
use Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory as DataProviderCollectionFactory;

class CollectionFactory
{
    public function afterGetReport(DataProviderCollectionFactory $subject, $result, $requestName)
    {
        if (($requestName === 'sales_order_grid_data_source') && $result instanceof Collection) {
            $result->getSelect()->joinLeft('sales_order', 'main_table.entity_id = sales_order.entity_id', ['coupon_code', 'discount_amount']);
        }
        return $result;
    }
}
