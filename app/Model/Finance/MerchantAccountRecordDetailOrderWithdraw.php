<?php
/**
 * 商家财务记录详情订单（出账）-提现详情表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 17:59
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class MerchantAccountRecordDetailOrderWithdraw extends AppModel {
	public $name 	    = 'MerchantAccountRecordDetailOrderWithdraw'; 	  	 //模型名
	public $useTable    = 'merchant_account_record_detail_order_withdraw';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取商家财务记录详情订单（出账）-提现详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 17:59
	 * ------------------------------------------------------------
	 */
	public function getMerchantAccountRecordDetailOrderWithdraw($withdraw_apply_detail_id) {
		$sql  = "SELECT `id`,`order_id`,`member_id`,`merchant_id`,`platform_id`,`money`,`bank_card_number`,`cardholder_name`,`out_trade_no`,`trade_no`,`withdraw_time`,`is_usable`,`payee_bank_code`,`bank_card_bind_phone` FROM `finance_center`.`merchant_account_record_detail_order_withdraw` AS `MerchantAccountRecordDetailOrderWithdraw` WHERE `id`='{$withdraw_apply_detail_id}' AND `is_delete`='2'";
		return $this->query($sql);
	}
}