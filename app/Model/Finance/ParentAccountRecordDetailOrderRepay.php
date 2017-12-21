/<?php
/**
 * 一对多班级订单支付记录
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 22:38
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class ParentAccountRecordDetailOrderRepay extends AppModel {
	public $name 	    = 'ParentAccountRecordDetailOrderRepay'; 	  	 //模型名
	public $useTable    = 'parent_account_record_detail_order_repays';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 一对多班级订单支付记录
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:38
	 * ------------------------------------------------------------
	 */
	public function getAllParentAccountRecordDetailOrderRepay(){
		$sql  = " SELECT `id`, `merchant_id`, `platform_id`, `campus_id`, `order_id`, `sub_order_id`, `goods_id`, `amount`, `type`, `creator_id`, `created` FROM `finance_center`.`parent_account_record_detail_order_repays` AS ParentAccountRecordDetailOrderRepay ";

		// $sql .= " WHERE merchant_id='4720d109e612723b137db83b53c024bd' ";

		return $this->query($sql);
	}

	/**
	 * 获取订单补缴记录总金额
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:38
	 * ------------------------------------------------------------
	 */
	public function getOrderRepayAmountByOrderId($order_id){
		$sql = " SELECT SUM(amount) AS amount FROM `finance_center`.`parent_account_record_detail_order_repays` ";
		$sql .= " WHERE order_id = '{$order_id}' ";
		return $this->query($sql);
	}
}