<?php
/**
 * 员工登录日志模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-02-13 18:19
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class EmployeeLoginLog extends AppModel {
	public $name 	    = 'EmployeeLoginLog'; //模型名
	public $useTable    = 'ec_login_logs'; //模型使用的数据表
	public $useDbConfig = 'system_center'; //使用的数据库连接

	/**
	 * 获取员工登录日志
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-02-13 18:19
	 * ------------------------------------------------------------
	 */
	public function getEmployeeLoginLog($conditions = array()) {
		$sql  = "SELECT member_id,merchant_id,employee_id FROM `system_center`.`ec_login_logs` AS `ec_login_log` WHERE `status`=1";
		if ($merchant_id = getArrVal($conditions, 'merchant_id')) {
			$sql .= " AND merchant_id='{$merchant_id}' ";
		}
		return $this->query($sql);
	}
}