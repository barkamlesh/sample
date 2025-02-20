<?php

namespace Kamlesh\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Kamlesh\Sample\Model\SampleFactory;

class View extends Action
{
    protected $resultPageFactory;
    protected $registry;
    protected $sampleFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        SampleFactory $sampleFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->sampleFactory = $sampleFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $sample = $this->sampleFactory->create()->load($id);

        if (!$sample->getId()) {
            $this->messageManager->addErrorMessage(__('This sample no longer exists.'));
            return $this->_redirect('*/*/');
        }

        $this->registry->register('current_sample', $sample);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('View Sample'));

        return $resultPage;
    }
}