<?php
namespace  Members\AffiliateMembers\Block\Adminhtml\Members;

class Edit extends \Magento\Backend\Block\Widget\Form\Container {
    
    protected $_coreRegistry = null;
    
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    
    protected function _construct() {
        $this->_objectId = 'members_id';
        $this->_blockGroup = 'Members_AffiliateMembers';
        $this->_controller = 'adminhtml_members';

        parent::_construct();

            $this->buttonList->update('save', 'label', __('Save Affiliate Members'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        
            $this->buttonList->update('delete', 'label', __('Delete Members'));       
    }

    
    public function getHeaderText() {
        if ($this->_coreRegistry->registry('affiliatemembers_members')->getId()) {
            return __("Edit Members '%1'", $this->escapeHtml($this->_coreRegistry->registry('affiliatemembers_members')->getTitle()));
        } else {
            return __('New Members');
        }
    }

    
    protected function _getSaveAndContinueUrl() {
        return $this->getUrl('affiliatemembers/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}

