
> Magento 2.4 PHP 7.4 
> 
> **My conclusions:**
>
> - In my opinion, the best performance solution would be to add columns coupon_code and discount_amount to sales_order_grid table. Via declarative schema and patch data for add data to sales_order_grid.
> - You can also use "Magento\Sales\Model\ResourceModel\Order\Grid\Collection extends Magento\Framework\Data\Collection\AbstractDb" Method "_renderFiltersBefore" used before generating a query in the database. Rewrite "_renderFiltersBefore" add ->joinLeft('sales_order', 'main_table.entity_id = sales_order.entity_id', ['coupon_code', 'discount_amount']) to collection.
> - You can also use plugin on "Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory" In "getReport" is created a collection with the help of the object manager. It was just created and not rendered. We can use to "leftJoin" or something else, but the plugin solution has a minus it is check on "requestName".
