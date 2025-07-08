<?php
namespace Nomad\ShippingReturns\Block;

use Magento\Framework\View\Element\Template;

class Promotions extends Template
{
    public function getMessage()
    {
        return __('Free shipping on orders over $50!');
    }
}
