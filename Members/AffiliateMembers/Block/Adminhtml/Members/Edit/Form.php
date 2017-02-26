<?php
namespace  Members\AffiliateMembers\Block\Adminhtml\Members\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic {
 
    protected $_systemStore;

    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    
    protected function _construct() {
        parent::_construct();
        $this->setId('members_form');
        $this->setTitle(__('Members Information'));
    }

    
    protected function _prepareForm() {
        $model = $this->_coreRegistry->registry('affiliatemembers_members');

        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getMembersId()) {
            $fieldset->addField('member_id', 'hidden', ['name' => 'member_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Member Name'), 'title' => __('Member Name'), 'required' => true]
        );

       

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );
        $fieldset->addField(
        	'image',
        	'image',
        	[
        		'name' => 'image',
        		'label' => __('Image'),
        		'title' => __('Image')
        	]
        );
        // $fieldset->addField(
        // 	'image',
        // 	'file',
        // 	 ['title' => __('Image'), 
        // 	 'label' => __('Image'), 
        // 	 name => 'image', 
        // 	 required => true
        // 	 ]
        // 	);
        if (!$model->getId()) {
            $model->setData('status', '1');
        }


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}