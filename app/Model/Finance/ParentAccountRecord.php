<?php
/**
 * 家长账户记录表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 22:41
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class ParentAccountRecord extends AppModel {
	public $name 	    = 'ParentAccountRecord'; 	  	 //模型名
	public $useTable    = 'parent_account_records';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取家长账户记录表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:41
	 * ------------------------------------------------------------
	 */
	public function getParentAccountRecord($account_record_id) {
		$sql  = "SELECT `id`,`account_id`,`record_type`,`amount`,`created` FROM `finance_center`.`parent_account_records` AS `ParentAccountRecord` WHERE `id`='{$account_record_id}'";
		return $this->query($sql);
	}

	/**
	 * 通过金额和创建时间 获取家长出账记录
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:41
	 * ------------------------------------------------------------
	 */
	public function getOutOfAccountByAmountAndCreated($amount, $created){
		$sql  = "SELECT `id`,`account_id`,`record_type`,`amount`,`created` FROM `finance_center`.`parent_account_records` AS `ParentAccountRecord` WHERE `amount`={$amount} AND created='{$created}' AND record_type=2";
		return $this->query($sql);
	}

	/**
	 * 获取家长账户记录表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:41
	 * ------------------------------------------------------------
	 */
	public function getAllParentAccountRecordId($offset, $size){
		$sql  = " SELECT `id`,`record_type` FROM `finance_center`.`parent_account_records` AS `ParentAccountRecord` ";
		$sql .= " LIMIT {$offset}, {$size} ";
		return $this->query($sql);
	}

	/**
	 * 获取总条数
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:41
	 * ------------------------------------------------------------
	 */
	public function getParentAccountRecordCount(){
		$sql  = " SELECT COUNT(`id`) AS num FROM `finance_center`.`parent_account_records` AS `ParentAccountRecord` ";
		return $this->query($sql);
	} 
}