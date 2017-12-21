<?php
/**
 * 商家银行卡表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-12-28 10:45
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class MerchantBank extends AppModel {
	public $name 	    = 'MerchantBank'; 	  	 //模型名
	public $useTable    = 'merchant_banks';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取商家银行卡表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-12-28 10:46
	 * ------------------------------------------------------------
	 */
	public function getMerchantBankByCardNumber($card_number) {
		$sql  = "SELECT card_account_type,card_contact_number FROM `finance_center`.`merchant_banks` AS `MerchantBank` WHERE is_usable='1' AND is_delete='2' AND card_number='{$card_number}'";
		return $this->query($sql);
	}
}