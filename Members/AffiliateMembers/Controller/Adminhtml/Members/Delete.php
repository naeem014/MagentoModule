<?php
namespace  Members\AffiliateMembers\Controller\Adminhtml\Members;

class Delete extends \Magento\Backend\App\Action {
	
	public function execute() {
		$id = $this->getRequest()->getParam('member_id');
		$resultRedirect = $this->resultRedirectFactory->create();
		if ($id) {
			try {
				$model = $this->_objectManager->create('Members\AffiliateMembers\Model\Members');
				$model->load($id);
				$model->delete();
				$this->messageManager->addSuccess(__('The member has been deleted.'));
				return $resultRedirect->setPath('*/*/');
			} catch (\Exception $e) {
				 $this->messageManager->addError($e->getMessage());
				 return $resultRedirect->setPath('*/*/edit', ['member_id' => $id]);
			}
		}
		$this->messageManager->addError(__('Member not found.'));
		return $resultRedirect->setPath('*/*/');
	}
}