<?php
/**
 * 家长商家财务账户表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-02-04 17:59
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class ParentAccountMerchant extends AppModel {
	public $name        = 'ParentAccountMerchant'; //模型名
	public $useTable    = 'parent_account_merchants'; //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取商家家长财务账户表
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-02-04 17:59
	 * ------------------------------------------------------------
	 */
	public function getParentAccountMerchant($conditions = array()) {
		$sql  = "SELECT id FROM `finance_center`.`parent_account_merchants` AS `parent_account_merchant` WHERE `is_usable`=1";
		if ($merchant_id = getArrVal($conditions, 'merchant_id')) {
			$sql .= " AND merchant_id='{$merchant_id}' ";
		}
		if ($parent_id = getArrVal($conditions, 'parent_id')) {
			$sql .= " AND parent_id='{$parent_id}' ";
		}
		return $this->query($sql);
	}
}