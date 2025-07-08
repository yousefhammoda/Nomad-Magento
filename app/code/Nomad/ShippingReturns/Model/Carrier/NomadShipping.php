<?php
namespace Nomad\ShippingReturns\Model\Carrier;

use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Shipping\Model\Rate\Result\MethodFactory;
use Psr\Log\LoggerInterface;

class NomadShipping extends AbstractCarrier implements CarrierInterface
{
    protected $_code = 'nomadshipping';
    protected $_rateResultFactory;
    protected $_rateMethodFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        LoggerInterface $logger,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $logger, $data);
    }

    public function collectRates(\Magento\Quote\Model\Quote\Address\RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $result = $this->_rateResultFactory->create();
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($this->_code);
        $method->setMethodTitle($this->getConfigData('title'));

        $price = $this->getShippingPrice($request);

        $method->setPrice($price);
        $method->setCost($price);
        $result->append($method);

        return $result;
    }

    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('title')];
    }

    private function getShippingPrice($request)
    {
        $mode = $this->getConfigData('mode');
        $basePrice = (float)$this->getConfigData('price');

        if ($mode === 'dynamic') {
            $qty = array_sum($request->getPackageQty());
            return $basePrice * max(1, $qty);
        }

        return $basePrice;
    }
}
