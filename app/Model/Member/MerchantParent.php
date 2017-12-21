<?php
/**
 * 商家家长表操作
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-02-04 17:21
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class MerchantParent extends AppModel {
	public $name        = 'MerchantParent'; //模型名
	public $useTable    = 'uc_merchant_parent'; //模型使用的数据表
	public $useDbConfig = 'member_center'; //使用的数据库连接

	/**
	 * 获取商家家长
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-02-04 17:21
	 * ------------------------------------------------------------
	 */
	public function getMerchantParent($conditions = array()){
		$sql = "SELECT merchant_id, parent_id, creator_id, created, modifier_id, modified, data_enter_type FROM `member_center`.`uc_merchant_parent` AS `merchant_parent` WHERE is_usable=1 AND is_delete=2";
		return $this->query($sql);
	}
}