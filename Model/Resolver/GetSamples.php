<?php

namespace Kamlesh\Sample\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Kamlesh\Sample\Model\ResourceModel\Sample\CollectionFactory;

class GetSamples implements ResolverInterface
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $collection = $this->collectionFactory->create();
        $samples = $collection->getItems();
        $result = [];
        foreach ($samples as $sample) {
            $result[] = $sample->getData();
        }
        return $result;
    }
}