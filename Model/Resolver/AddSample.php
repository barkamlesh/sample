<?php

namespace Kamlesh\Sample\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Kamlesh\Sample\Model\SampleFactory;
use Magento\Framework\Exception\LocalizedException;

class AddSample implements ResolverInterface
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
        // Check if the user is authenticated
        if (!$context->getUserId()) {
            throw new LocalizedException(__('You must be logged in to add a sample.'));
        }

        $sample = $this->sampleFactory->create();
        $sample->setData($args);
        $sample->save();
        return $sample->getData();
    }
}