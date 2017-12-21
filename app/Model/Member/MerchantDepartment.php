<?php
/**
 * 部门操作
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-06-14 18:44
 * @author gaoxiang<gaoxiang@xiaohe.com>
 */
class MerchantDepartment extends AppModel {
	public $name 	    = 'MerchantDepartment'; 	  	 //模型名
	public $useTable    = 'mc_merchant_departments';  	 //模型使用的数据表
	public $useDbConfig = 'member_center'; //使用的数据库连接

	/**
	 * 添加部门
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author gaoxiang<gaoxiang@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-06-14 18:44
	 * ------------------------------------------------------------
	 */
	public function addMerchantDepartment($data = array()) {
		$keys    = array_keys($data);
		$keys 	 = implode("`,`", $keys);
		$values = array_values($data);
		$values = implode("','", $values);

		$sql = sprintf("INSERT INTO `member_center`.`mc_merchant_departments`(`%s`) VALUES ('%s')", $keys, $values);
		$this->query($sql);
		return true;
	}
}