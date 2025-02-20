<?php

namespace Kamlesh\Sample\Model;

use Magento\Framework\Model\AbstractModel;

class Sample extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Kamlesh\Sample\Model\ResourceModel\Sample::class);
    }
}