<?php
/**
 * 商家账户记录表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 17:56
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class MerchantAccountRecord extends AppModel {
	public $name 	    = 'MerchantAccountRecord'; 	  	 //模型名
	public $useTable    = 'merchant_account_records';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取商家账户记录表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 17:56
	 * ------------------------------------------------------------
	 */
	public function getMerchantAccountRecord($account_record_id) {
		$sql  = "SELECT `id`,`account_id`,`record_type`,`amounts`,`created` FROM `finance_center`.`merchant_account_records` AS `MerchantAccountRecord` WHERE `id`='{$account_record_id}'";
		return $this->query($sql);
	}
}