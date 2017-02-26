<?php
namespace Members\AffiliateMembers\Model\ResourceModel\Members;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
 
	protected $_idFieldName = 'member_id';

    protected function _construct() {
        $this->_init('Members\AffiliateMembers\Model\Members', 
        	'Members\AffiliateMembers\Model\ResourceModel\Members');
    }
}