<?php
/**
 * 员工财务记录详情订单（出账）表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-28 18:44
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class EmployeeAccountRecordDetailOrder extends AppModel {
	public $name 	    = 'EmployeeAccountRecordDetailOrder'; 	  	 //模型名
	public $useTable    = 'employee_account_record_detail_orders';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 员工财务记录详情订单（出账）详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-28 18:44
	 * ------------------------------------------------------------
	 */
	public function getEmployeeAccountRecordDetailOrder($order_id) {
		$sql  = "SELECT `id`,`account_record_id`,`trade_no`,`member_id`,`merchant_id`,`price`,`goods_name`,`goods_describe`,`status`,`order_type` FROM `finance_center`.`employee_account_record_detail_orders` AS `EmployeeAccountRecordDetailOrder` WHERE `id`='{$order_id}'";
		return $this->query($sql);
	}
}