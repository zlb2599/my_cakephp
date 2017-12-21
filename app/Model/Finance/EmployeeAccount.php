<?php
/**
 * 员工财务账户表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-29 15:31
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class EmployeeAccount extends AppModel {
	public $name 	    = 'EmployeeAccount'; 	  	 //模型名
	public $useTable    = 'employee_accounts';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取员工财务账户表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-29 15:31
	 * ------------------------------------------------------------
	 */
	public function getEmployeeAccount($account_id) {
		$sql  = "SELECT `id`,`member_id`,`balances`,`lock`,`lock_withdraw`,`is_usable` FROM `finance_center`.`employee_accounts` AS `EmployeeAccount` WHERE `id`='{$account_id}'";
		return $this->query($sql);
	}
}