<?php
namespace  Members\AffiliateMembers\Controller\Adminhtml\Members;

class Save extends \Magento\Backend\App\Action {
	
	protected $adapterFactory;
	protected $uploader;
	protected $filesystem;

	public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Image\AdapterFactory $adapterFactory, \Magento\MediaStorage\Model\File\UploaderFactory $uploader, \Magento\Framework\Filesystem $filesystem) {
		
		$this->adapterFactory = $adapterFactory;
		$this->uploader = $uploader;
		$this->filesystem = $filesystem;

		parent::__construct($context);
	}

	public function execute() {
		$data = $this->getRequest()->getPostValue();
		$resultRedirect = $this->resultRedirectFactory->create();
		 if ($data) {
		 	if (isset($_FILES['image']) && isset($_FILES['image']['name']) && strlen($_FILES['image']['name'])) {
		 		try {
		 			$uploader = $this->uploader->create(['fileId' => 'image']);
		 			$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
		 			$imageAdapter = $this->adapterFactory->create();
		 			$uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
		 			$uploader->setAllowRenameFiles(true);
		 			$uploader->setFilesDispersion(true);
		 			$mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
		 			$result = $uploader->save('images/');
		 			$data['image'] = 'images/'.$result['file'];
		 		} catch (\Exception $e) {
		 			$this->messageManager->addError($e->getMessage());
		 		}	
		 	}
		 	$model = $this->_objectManager->create('Members\AffiliateMembers\Model\Members');
		 	$id = $this->getRequest()->getParam('member_id');
		 	if ($id) {
                $model->load($id);
            }
            $model->setData($data);
            $this->_eventManager->dispatch(
                'affiliatemembers_members_prepare_save',
                ['member' => $model, 'request' => $this->getRequest()]
            );
            try {
            	$model->save();
            	$this->messageManager->addSuccess(__('Member Saved.'));
            	$this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
            	if ($this->getRequest()->getParam('back')) {
            		return $resultRedirect->setPath('*/*/edit', ['member_id' => $model->getId(), '_current' => true]);
            	}
            	return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the post.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['member_id' => $this->getRequest()->getParam('member_id')]);
        }
        return $resultRedirect->setPath('*/*/');
	}
}