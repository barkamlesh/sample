<?php

namespace Kamlesh\Sample\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Kamlesh\Sample\Model\Source\Status as StatusOptions;

class Status extends Column
{
    /**
     * @var StatusOptions
     */
    protected $statusOptions;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StatusOptions $statusOptions
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StatusOptions $statusOptions,
        array $components = [],
        array $data = []
    ) {
        $this->statusOptions = $statusOptions;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $options = $this->statusOptions->toArray();
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['status'])) {
                    $item['status'] = $options[$item['status']];
                }
            }
        }

        return $dataSource;
    }
}
