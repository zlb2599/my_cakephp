<?php
/**
 * 首缴&补缴数据记录
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-25 16:29
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class OrderClassOtmsPayRecord extends AppModel {
	public $name        = 'OrderClassOtmsPayRecord'; 	  	 //模型名
	public $useTable    = 'bc_order_class_otms_pay_records';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接

	/**
	 * 获取所有的数据
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-25 16:29
	 * ------------------------------------------------------------
	 */
	public function getAllOrderClassOtmsPayRecord(){
		$sql = " SELECT `id`, `merchant_id`, `platform_id`, `order_id`, `sub_order_id`, `amount`, `type`, `creator_id`, `created` FROM `business_center`.`bc_order_class_otms_pay_records` ";
		$sql .= " WHERE amount >= 0 ";
		// $sql .= " AND `merchant_id`='4720d109e612723b137db83b53c024bd' ";
		return $this->query($sql);
	}

	/**
	 * 获取所有的数据
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-25 16:29
	 * ------------------------------------------------------------
	 */
	public function getAllOrderClassOtmsPayRecordById($id){
		$sql = " SELECT `id`, `merchant_id`, `platform_id`, `order_id`, `sub_order_id`, `amount`, `type`, `creator_id`, `created` FROM `business_center`.`bc_order_class_otms_pay_records` ";
		$sql .= " WHERE amount >= 0 ";
		$sql .= sprintf(" AND id IN ('%s')", implode("','", (array)$id));
		return $this->query($sql);
	}
}