<?php

namespace Kamlesh\Sample\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Kamlesh\Sample\Model\ResourceModel\Sample\CollectionFactory;
use Magento\Framework\Registry;

class SampleEditDataProvider extends AbstractDataProvider
{
    protected $loadedData;
    protected $registry;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        Registry $registry,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->registry = $registry;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $sample = $this->registry->registry('current_sample');
        if ($sample) {
            $this->loadedData[$sample->getId()] = $sample->getData();
        }

       
        // Debug statement to check loaded data
        //error_log(print_r($this->loadedData, true));

        return $this->loadedData;
    }
}