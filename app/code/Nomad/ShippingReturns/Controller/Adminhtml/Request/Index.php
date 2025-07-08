<?php
namespace Nomad\ShippingReturns\Controller\Adminhtml\Request;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Nomad_ShippingReturns::requests';
    private $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Nomad_ShippingReturns::requests');
        $resultPage->getConfig()->getTitle()->prepend(__('Return Requests'));
        return $resultPage;
    }
}
