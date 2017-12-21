<?php
/**
 * 商家财务账户表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 17:54
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class MerchantAccount extends AppModel {
	public $name 	    = 'MerchantAccount'; 	  	 //模型名
	public $useTable    = 'merchant_accounts';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取商家财务账户表详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 17:54
	 * ------------------------------------------------------------
	 */
	public function getMerchantAccount($account_id) {
		$sql  = "SELECT `id`,`member_id`,`balances`,`lock`,`lock_withdraw`,`is_usable` FROM `finance_center`.`merchant_accounts` AS `MerchantAccount` WHERE `id`='{$account_id}'";
		return $this->query($sql);
	}

    /**
     * 获取商家财务账户表详情通过商家ID
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @param $merchant_id
     * ------------------------------------------------------------
     * @return mixed
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-05 13:16
     * ------------------------------------------------------------
     */
    public function getMerchantAccountByMerchant($merchant_id) {
        $sql  = "SELECT `id`,`member_id`,`balances`,`lock`,`lock_withdraw`,`is_usable` ";
        $sql .= "FROM `finance_center`.`merchant_accounts` AS `MerchantAccount` WHERE `merchant_id`='{$merchant_id}' LIMIT 1";
        $result = $this->query($sql);

        return isset($result[0]['MerchantAccount']) ? $result[0]['MerchantAccount'] : array();
    }
}