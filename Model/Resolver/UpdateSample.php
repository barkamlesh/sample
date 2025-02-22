<?php

namespace Kamlesh\Sample\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Kamlesh\Sample\Model\SampleFactory;

class UpdateSample implements ResolverInterface
{
    protected $sampleFactory;

    public function __construct(SampleFactory $sampleFactory)
    {
        $this->sampleFactory = $sampleFactory;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $sample = $this->sampleFactory->create()->load($args['entity_id']);
        if (!$sample->getId()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Sample not found'));
        }
        $sample->addData($args);
        $sample->save();
        return $sample->getData();
    }
}