<?php
namespace Members\AffiliateMembers\Model\Api\Data;

interface MembersInterface {
	CONST MEMBER_ID = 'member_id';
	CONST NAME = 'name';
	CONST STATUS = 'status';
	CONST IMAGE = 'image';
	CONST CREATED_AT = 'created_at';
	CONST UPDATED_AT = 'updated_at';

	public function getId();
	public function getName();
	public function getStatus();
	public function getImage();
	public function getCreationTime();
	public function getUpdatedTime();
	public function setId($id);
	public function setName($name);
	public function setStatus($status);
	public function setImage($image);
	public function setCreationTime($created_at);
	public function setUpdatedTime($updated_at);

}