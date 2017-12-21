<?php
/**
 * 员工账户记录表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-29 15:22
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class EmployeeAccountRecord extends AppModel {
	public $name 	    = 'EmployeeAccountRecord'; 	  	 //模型名
	public $useTable    = 'employee_account_records';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取员工账户记录表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-29 15:22
	 * ------------------------------------------------------------
	 */
	public function getEmployeeAccountRecord($account_record_id) {
		$sql  = "SELECT `id`,`account_id`,`record_type`,`amounts`,`created`,`platform_id` FROM `finance_center`.`employee_account_records` AS `EmployeeAccountRecord` WHERE `id`='{$account_record_id}'";
		return $this->query($sql);
	}
}