<?php
	namespace Members\AffiliateMembers\Model\Members\Source;

	class Status implements \Magento\Framework\Data\OptionSourceInterface {
		
		protected $post;

		public function __construct(\Members\AffiliateMembers\Model\Members $post) {
			$this->post = $post;
		}

		public function toOptionArray() {
			$options[] = ['label' => '', 'value' => ''];
			$availableOptions = $this->post->getAvailableStatuses();
			foreach ($availableOptions as $key => $value) {
	            $options[] = [
	                'label' => $value,
	                'value' => $key,
	            ];
	        }
	        return $options;
		}

	}