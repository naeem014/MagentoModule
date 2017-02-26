<?php
namespace Members\AffiliateMembers\Model\ResourceModel;
 
class Members extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    
    protected $_date;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Magento\Framework\Stdlib\DateTime\DateTime $date, $resourcePrefix = null) {
    	parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }
    protected function _construct() {
        $this->_init('affiliate_members', 'member_id');
    }

    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object) {
    	if ($object->isObjectNew() && !$object->hasCreationTime()) {
    		$object->setCreationTime($this->_date->gmtDate());
    	}
    	$object->setUpdatedTime($this->_date->gmtDate());
    	return parent::_beforeSave($object);
    }
}