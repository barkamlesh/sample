<?php

namespace Kamlesh\Sample\Ui\Component\Listing;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\RequestInterface;

class SampleActions extends Column
{
    /** @var UrlInterface */
    protected $urlBuilder;

    /** @var RequestInterface */
    protected $request;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        RequestInterface $request,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $formKey = $this->request->getParam('form_key');
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->urlBuilder->getUrl(
                            'sample/sample/edit',
                            ['id' => $item['entity_id'], 'form_key' => $formKey]
                        ),
                        'label' => __('Edit'),
                        'hidden' => false,
                    ],
                    'delete' => [
                        'href' => $this->urlBuilder->getUrl(
                            'sample/sample/delete',
                            ['entity_id' => $item['entity_id'], 'form_key' => $formKey]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $item['name']),
                            'message' => __('Are you sure you want to delete %1?', $item['name']),
                        ],
                    ],
                    'view' => [ // Custom action
                        'href' => $this->urlBuilder->getUrl(
                            'sample/sample/view',
                            ['id' => $item['entity_id']]
                        ),
                        'label' => __('View'),
                        'hidden' => false,
                    ],
                ];
            }
        }

        return $dataSource;
    }
}