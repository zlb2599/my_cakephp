<?php
/**
 * 家长财务账户表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 22:39
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class ParentAccount extends AppModel {
	public $name 	    = 'ParentAccount'; 	  	 //模型名
	public $useTable    = 'parent_accounts';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取家长财务账户表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:39
	 * ------------------------------------------------------------
	 */
	public function getParentAccount($account_id) {
		$sql  = "SELECT `id`,`parent_id`,`balances`,`lock`,`consume`,`withdraw`,`is_usable`,`creator_id`,`created`,`modifier_id`,`modified` FROM `finance_center`.`parent_accounts` AS `ParentAccount` WHERE `id`='{$account_id}'";
		return $this->query($sql);
	}

	/**
	 * 获取家长财务账户表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:39
	 * ------------------------------------------------------------
	 */
	public function getParentAccountByParentId($parent_id){
		$sql  = "SELECT `id`,`parent_id`,`balances`,`lock`,`consume`,`withdraw`,`is_usable`,`creator_id`,`created`,`modifier_id`,`modified` FROM `finance_center`.`parent_accounts` AS `ParentAccount` WHERE `parent_id`='{$parent_id}'";
		return $this->query($sql);
	}
}