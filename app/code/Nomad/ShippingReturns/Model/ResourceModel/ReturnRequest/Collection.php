<?php
namespace Nomad\ShippingReturns\Model\ResourceModel\ReturnRequest;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Nomad\ShippingReturns\Model\ReturnRequest as Model;
use Nomad\ShippingReturns\Model\ResourceModel\ReturnRequest as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
