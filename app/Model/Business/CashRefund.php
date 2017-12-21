<?php
/**
 * 线下现金退费
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-25 16:29
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class CashRefund extends AppModel {
	public $name        = 'CashRefund'; 	  	 //模型名
	public $useTable    = 'fc_cash_refunds';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接

	/**
	 * 获取所有的数据
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-25 16:29
	 * ------------------------------------------------------------
	 */
	public function getAllCashRefund(){
		$sql = " SELECT `id`, `merchant_id`, `platform_id`, `order_id`, `sub_order_id`, `class_id`, `campus_id`, `total_amount`, `type`, `creator_id`, `created`, `modifier_id`, `modified`, `is_usable`, `is_delete` FROM `business_center`.`fc_cash_refunds` ";
		$sql .= " WHERE total_amount >= 0 ";
		return $this->query($sql);
	}
}