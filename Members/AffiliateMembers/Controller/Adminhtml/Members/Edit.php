<?php
namespace  Members\AffiliateMembers\Controller\Adminhtml\Members;

class Edit extends \Magento\Backend\App\Action {
	protected $_coreRegistry = null;
	protected $resultPageFactory;

	public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $registry) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry = $registry;
		parent::__construct($context);
	}

	 protected function _initAction() {
	 	$resultPage = $this->resultPageFactory->create();
	 	$resultPage->setActiveMenu('Members_AffiliateMembers::members');
	 	return $resultPage;
	 }

	 public function execute() {
	 	$id = $this->getRequest()->getParam('member_id');
	 	$model = $this->_objectManager->create('Members\AffiliateMembers\Model\Members');
	 	if ($id) {
	 		$model->load($id);
	 		if (!$model->getId()) {
	 			$this->messageManager->addError(__('Member does not exist.'));
	 			$resultRedirect = $this->resultRedirectFactory->create();
	 			return $resultRedirect->setPath('*/*/');
	 		}
	 	}
	 	$data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
	 	if (!empty($data)) {
	 		$model->setData($data);
	 	}

	 	$this->_coreRegistry->register('affiliatemembers_members', $model);
	 	$resultPage = $this->_initAction();
	 	$resultPage->getConfig()->getTitle()->prepend(__('Members'));
	 	$resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Member'));

	 	return $resultPage;
	}
}
