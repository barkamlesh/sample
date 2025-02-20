<?php

namespace Kamlesh\Sample\Model\ResourceModel\Sample;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Kamlesh\Sample\Model\Sample as Model;
use Kamlesh\Sample\Model\ResourceModel\Sample as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}