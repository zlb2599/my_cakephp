<?php
/**
 * 家长财务记录详情订单（一对多班级订单）表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-25 20:30
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class ParentAccountRecordDetailOrderClassOtm extends AppModel {
	public $name 	    = 'ParentAccountRecordDetailOrderClassOtm'; 	  	 //模型名
	public $useTable    = 'parent_account_record_detail_order_class_otms';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 家长财务记录详情订单（一对多班级订单）详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-25 20:30
	 * ------------------------------------------------------------
	 */
	public function getParentAccountRecordDetailOrderClassOtm($id) {
		$id = implode("','", (array)$id);
		$sql = "SELECT `id`,`order_id`,`goods_id`,`transfer_order_id`,`transfer_class_otms_id`,`status`,`real_amount`,`parent_id`,`student_id`,`platform_id`,`merchant_id`,`creator_id`,`modified`,`is_online`,`data_enter_type` FROM `finance_center`.`parent_account_record_detail_order_class_otms` AS `ParentAccountRecordDetailOrderClassOtm` WHERE `id` IN ('{$id}') ";
		return $this->query($sql);
	}

	/**
	 * 家长财务记录详情订单（一对多班级订单）详情
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-25 20:30
	 * ------------------------------------------------------------
	 */
	public function getParentAccountRecordDetailOrderClassOtmByOrderId($order_id){
		$order_id = implode("','", (array)$order_id);
		$sql  = "SELECT `id` FROM `finance_center`.`parent_account_record_detail_order_class_otms` AS `ParentAccountRecordDetailOrderClassOtm` WHERE `order_id` IN ('{$order_id}')";
		return $this->query($sql);
	}

	/**
	 * [getOrderInfo description]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function getOrderInfo(array $data)
	{
		$sql = '';
		$sql .= 'SELECT a.goods_id,SUM(a.real_amount) AS real_amounts FROM ';
		$sql .= '`finance_center`.`parent_account_record_detail_order_class_otms` AS a ';
		$sql .= 'WHERE TRUE ';
		if (!empty($ids = $data['ids'])) {
			$ids = "'" . implode("','", $ids) . "'";
			$sql .= "AND a.goods_id IN ({$ids}) ";
		}
		$sql .= "AND a.status = '2' ";
		$sql .= 'GROUP BY a.goods_id';
		$entity = $this->query($sql);

		return $entity;
	}
}