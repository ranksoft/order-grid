<?php
declare(strict_types = 1);

namespace RANK\OrderGrid\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Psr\Log\LoggerInterface;

class AddDataToOrderGrid implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;

    private LoggerInterface $logger;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }
    public function apply(): void
    {
        $this->moduleDataSetup->startSetup();
        try {
            $connection = $this->moduleDataSetup->getConnection();
            $sql = "UPDATE sales_order_grid LEFT JOIN sales_order ON sales_order_grid.entity_id = sales_order.entity_id
                    SET sales_order_grid.coupon_code = sales_order.coupon_code, sales_order_grid.discount_amount = sales_order.discount_amount";
            $connection->query($sql);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        $this->moduleDataSetup->endSetup();
    }
    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
