<?php

namespace Kamlesh\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use Kamlesh\Sample\Model\SampleFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends Action
{
    protected $dataPersistor;
    protected $sampleFactory;

    public function __construct(
        Action\Context $context,
        SampleFactory $sampleFactory,
        DataPersistorInterface $dataPersistor
    ) {
        $this->sampleFactory = $sampleFactory;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            return $this->_redirect('*/*/');
        }

        $id = $this->getRequest()->getParam('entity_id');
        $model = $this->sampleFactory->create();

        if ($id) {
            $model->load($id);
        }

        $model->setData($data);

        try {
            $model->save();
            $this->messageManager->addSuccessMessage(__('The sample has been saved.'));
            $this->dataPersistor->clear('sample');

            if ($this->getRequest()->getParam('back')) {
                return $this->_redirect('*/*/edit', ['entity_id' => $model->getId()]);
            }
            return $this->_redirect('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $this->dataPersistor->set('sample', $data);
        return $this->_redirect('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
    }
}