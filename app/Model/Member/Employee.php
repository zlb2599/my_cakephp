<?php
/**
 * 员工操作
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-02-13 18:44
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class Employee extends AppModel {
	public $name 	    = 'Employee'; 	  	 //模型名
	public $useTable    = 'mc_employees';  	 //模型使用的数据表
	public $useDbConfig = 'member_center'; //使用的数据库连接

	/**
	 * 获取员工
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-02-13 18:44
	 * ------------------------------------------------------------
	 */
	public function getEmployee($conditions = array()) {
		$sql  = "SELECT id,member_id,merchant_id,created FROM `member_center`.`mc_employees` AS `employee` WHERE TRUE";
		if ($member_id = getArrVal($conditions, 'member_id')) {
			$sql .= " AND member_id='{$member_id}' ";
		}
		if ($merchant_id = getArrVal($conditions, 'merchant_id')) {
			$sql .= " AND merchant_id='{$merchant_id}' ";
		}
		if ($employee_id = getArrVal($conditions, 'employee_id')) {
			$employee_id = implode("','", $employee_id);
			$sql .= " AND id IN('{$employee_id}') ";
		}

		return $this->query($sql);
	} 
}