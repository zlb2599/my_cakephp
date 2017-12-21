/<?php
/**
 * 财务记录详情充值（进账）-退班/考勤退费详情表模型
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
class ParentAccountRecordDetailRechargeRefund extends AppModel {
	public $name 	    = 'ParentAccountRecordDetailRechargeRefund'; 	  	 //模型名
	public $useTable    = 'parent_account_record_detail_recharge_refunds';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 财务记录详情充值（进账）-退班/考勤退费详情表
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:38
	 * ------------------------------------------------------------
	 */
	public function getAllParentAccountRecordDetailRechargeRefund(){
		$sql  = "SELECT `id`, `recharge_id`, `merchant_id`, `platform_id`, `order_id`, `sub_order_id`, `transfer_order_id`, `transfer_sub_order_id`, `type`, `business_type`, `campus_id`, `total_amount`, `creator_id`, `created`, `modifier_id`, `modified`, `is_usable`, `is_delete` FROM `finance_center`.`parent_account_record_detail_recharge_refunds` AS ParentAccountRecordDetailRechargeRefund";
		$sql .= " WHERE `type`!=1 ";

		// $sql .= " AND merchant_id='4720d109e612723b137db83b53c024bd' ";

		return $this->query($sql);
	}
}