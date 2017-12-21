<?php
/**
 * 家长学员商家财务账户表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-02-05 15:56
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class ParentAccountStudentMerchant extends AppModel {
	public $name        = 'ParentAccountStudentMerchant'; //模型名
	public $useTable    = 'parent_account_student_merchants'; //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取商家家长学员财务账户表
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-02-05 15:56
	 * ------------------------------------------------------------
	 */
	public function getParentAccountStudentMerchant($conditions = array()) {
		$sql  = "SELECT id FROM `finance_center`.`parent_account_student_merchants` AS `parent_account_student_merchant` WHERE `is_usable`=1";
		if ($merchant_id = getArrVal($conditions, 'merchant_id')) {
			$sql .= " AND merchant_id='{$merchant_id}' ";
		}
		if ($parent_id = getArrVal($conditions, 'parent_id')) {
			$sql .= " AND parent_id='{$parent_id}' ";
		}
		if ($student_id = getArrVal($conditions, 'student_id')) {
			$sql .= " AND student_id='{$student_id}' ";
		}
		return $this->query($sql);
	}
}