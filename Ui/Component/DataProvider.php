<?php

namespace Kamlesh\Sample\Ui\Component;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;
use Kamlesh\Sample\Model\ResourceModel\Sample\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
   
    protected $collection;
    protected $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
    }

    public function getData()
    {
        // if (!$this->getCollection()->isLoaded()) {
        //     $this->getCollection()->load();
        // }
        $items = $this->getCollection()->getItems();
        
        // Convert items to an array of associative arrays
        $dataItems = [];
        foreach ($items as $item) {
            $dataItems[] = $item->getData();
        }

        // Here you can manipulate the data before it's returned
        $data = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => $dataItems,
        ];

        return $data;
    }
}