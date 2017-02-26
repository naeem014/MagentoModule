<?php
namespace Members\AffiliateMembers\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class MembersActions extends Column {
	const MEMBERS_URL_PATH_EDIT = 'affiliatemembers/members/edit';
	const MEMBERS_URL_PATH_DELETE = 'affiliatemembers/members/delete';
	protected $urlBuilder;
	private $editUrl;
	private $deleteUrl;

	public function __construct(ContextInterface $context,
	 UiComponentFactory $uiComponentFactory,
	  UrlInterface $urlBuilder,
	  array $components = [],
        array $data = [],
        $editUrl = self::MEMBERS_URL_PATH_EDIT,
        $deleteUrl = self::MEMBERS_URL_PATH_DELETE
        ) {
			$this->urlBuilder = $urlBuilder;
	        $this->editUrl = $editUrl;
	        $this->deleteUrl = $deleteUrl;
	        parent::__construct($context, $uiComponentFactory, $components, $data);
		}

	public function prepareDataSource(array $dataSource) {
		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as & $item) {
				$name = $this->getData('name');
				if (isset($item['member_id'])) {
					$item[$name]['edit'] = [
    					'href' => $this->urlBuilder->getUrl($this->editUrl, ['member_id' => $item['member_id']]),
    					'label' => __('Edit')
					];
					$item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl($this->deleteUrl, ['member_id' => $item['member_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'name' => __('Delete "${ $.$data.name }"'),
                            'message' => __('Are you sure you wan\'t to delete member: "${ $.$data.name }" ?')
                        ]
                    ];
                }
            }
        }
        return $dataSource;
	}
}