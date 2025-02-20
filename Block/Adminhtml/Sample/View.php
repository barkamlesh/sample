<?php

namespace Kamlesh\Sample\Block\Adminhtml\Sample;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;

class View extends Template
{
    protected $registry;

    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getSample()
    {
        return $this->registry->registry('current_sample');
    }
}