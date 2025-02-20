<?php

namespace kamlesh\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use kamlesh\Sample\Model\SampleFactory;

class Delete extends Action
{
    protected $sampleFactory;

    public function __construct(Action\Context $context, 
        SampleFactory $sampleFactory
    )
    {
        parent::__construct($context);
        $this->sampleFactory = $sampleFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        
        if ($id) {
            try {
                $sample = $this->sampleFactory->create();
                $sample->load($id);
                $sample->delete();
                $this->messageManager->addSuccessMessage(__('The sample has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $this->_redirect('*/*/');
    }
}