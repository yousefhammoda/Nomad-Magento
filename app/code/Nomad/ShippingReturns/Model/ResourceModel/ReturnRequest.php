<?php
namespace Nomad\ShippingReturns\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ReturnRequest extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('nomad_return_request', 'entity_id');
    }
}
