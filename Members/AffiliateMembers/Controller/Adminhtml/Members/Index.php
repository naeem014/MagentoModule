<?php
namespace Members\AffiliateMembers\Controller\Adminhtml\Members;

class Index extends \Magento\Backend\App\Action {
	
	protected $resultPageFactory;

	public function __construct(\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
	}

	public function execute() {
		$resultPage = $this->resultPageFactory->create();
 		$resultPage->setActiveMenu('Members_AffiliateMembers::members');
 		$resultPage->getConfig()->getTitle()->prepend(__('Members'));
 		return $resultPage;
 	}
}	