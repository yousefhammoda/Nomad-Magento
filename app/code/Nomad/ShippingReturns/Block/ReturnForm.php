<?php
namespace Nomad\ShippingReturns\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Data\Form\FormKey\Validator;

class ReturnForm extends Template
{
    private $formKey;

    public function __construct(
        Template\Context $context,
        Validator $formKey,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formKey = $formKey;
    }

    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
}
