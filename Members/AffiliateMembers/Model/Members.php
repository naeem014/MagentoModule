<?php
namespace Members\AffiliateMembers\Model;

use Members\AffiliateMembers\Model\Api\Data\MembersInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Members extends \Magento\Framework\Model\AbstractModel implements MembersInterface, IdentityInterface {
	
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const CACHE_TAG = 'affiliatemembers_members';
    protected $_cacheTag = 'affiliate_members';
    protected $_eventPrefix = 'affiliate_members';

    protected function _construct() {
        $this->_init('Members\AffiliateMembers\Model\ResourceModel\Members');
    }

    public function getAvailableStatuses() {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId() {
        return $this->getData(self::MEMBER_ID);
    }

    public function getName() {
        return $this->getData(self::NAME);    
    }

    public function getStatus() {
        return (bool) $this->getData(self::STATUS);    
    }

    public function getImage() {
        return $this->getData(self::IMAGE);    
    }

    public function getCreationTime() {
        return $this->getData(self::CREATED_AT);    
    }

    public function getUpdatedTime() {
        return $this->getData(self::UPDATED_AT);    
    }

    public function setId($id) {
        return $this->setData(self::MEMBER_ID, $id);
    }

    public function setName($name) {
        return $this->setData(self::NAME, $name);    
    }

    public function setStatus($status) {
        return (bool) $this->setData(self::STATUS, $status);    
    }

    public function setImage($image) {
        return $this->setData(self::IMAGE, $image);    
    }

    public function setCreationTime($created_at) {
        return $this->setData(self::CREATED_AT, $created_at);    
    }

    public function setUpdatedTime($updated_at) {
        return $this->setData(self::UPDATED_AT, $updated_at);    
    }
}