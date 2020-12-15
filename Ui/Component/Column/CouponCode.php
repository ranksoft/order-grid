<?php
declare(strict_types = 1);

namespace RANK\OrderGrid\Ui\Component\Column;

use Magento\Ui\Component\Listing\Columns\Column as UiColumn;

class CouponCode extends UiColumn
{
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (!$item['coupon_code']) {
                    $item['coupon_code'] = '<span style="color: red; font-weight: bold;"> ' . __('Without coupon') . '</span>';
                    continue;
                }
                $item['coupon_code'] = '<span style="color: green; font-weight: bold;"> ' . $item['coupon_code'] . '</span>';
            }
        }

        return $dataSource;
    }
}
