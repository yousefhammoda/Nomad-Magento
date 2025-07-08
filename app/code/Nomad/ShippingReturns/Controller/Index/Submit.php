<?php
namespace Nomad\ShippingReturns\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Nomad\ShippingReturns\Model\ReturnRequestFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Controller\Result\RedirectFactory;

class Submit extends Action
{
    private $returnRequestFactory;
    private $customerSession;
    private $resultRedirectFactory;

    public function __construct(
        Context $context,
        ReturnRequestFactory $returnRequestFactory,
        CustomerSession $customerSession,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->returnRequestFactory = $returnRequestFactory;
        $this->customerSession = $customerSession;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!isset($data['order_id'])) {
            return $this->resultRedirectFactory->create()->setPath('*/*');
        }

        $model = $this->returnRequestFactory->create();
        $model->setData([
            'order_id' => $data['order_id'],
            'customer_id' => $this->customerSession->getCustomerId(),
            'status' => 'pending'
        ]);
        $model->save();

        $this->messageManager->addSuccessMessage(__('Return request submitted.'));
        return $this->resultRedirectFactory->create()->setPath('*/*');
    }
}
