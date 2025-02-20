<?php

namespace Kamlesh\Sample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Sample extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('kamlesh_sample', 'entity_id');
    }
}