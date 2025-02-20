<?php

namespace Kamlesh\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Kamlesh_Sample::manage_sample');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Samples'));
        return $resultPage;
    }
}