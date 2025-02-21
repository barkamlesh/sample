<?php

namespace Kamlesh\Sample\Block\Adminhtml\Sample;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;

class Edit extends Container
{
    protected function _construct()
    {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Kamlesh_Sample';
        $this->_controller = 'adminhtml_sample';
        $this->_mode = 'edit';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Sample'));
        $this->buttonList->update('delete', 'label', __('Delete Sample'));
    }
}
