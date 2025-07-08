<?php
namespace Nomad\ShippingReturns\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Mode implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'flat', 'label' => __('Flat Rate')],
            ['value' => 'dynamic', 'label' => __('Dynamic Rate')],
        ];
    }
}
