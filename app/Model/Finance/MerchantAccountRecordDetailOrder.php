<?php
/**
 * 商家财务记录详情订单（出账）表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 17:58
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class MerchantAccountRecordDetailOrder extends AppModel {
	public $name 	    = 'MerchantAccountRecordDetailOrder'; 	  	 //模型名
	public $useTable    = 'merchant_account_record_detail_orders';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 商家财务记录详情订单（出账）详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 17:58
	 * ------------------------------------------------------------
	 */
	public function getMerchantAccountRecordDetailOrder($order_id) {
		$sql  = "SELECT `id`,`account_record_id`,`trade_no`,`member_id`,`merchant_id`,`price`,`goods_name`,`goods_describe`,`status`,`order_type` FROM `finance_center`.`merchant_account_record_detail_orders` AS `MerchantAccountRecordDetailOrder` WHERE `id`='{$order_id}'";
		return $this->query($sql);
	}
}