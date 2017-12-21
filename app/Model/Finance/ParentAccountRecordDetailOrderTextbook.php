<?php
/**
 * 财务记录详情订单（出账）-教材详情表
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
class ParentAccountRecordDetailOrderTextbook extends AppModel {
	public $name 	    = 'ParentAccountRecordDetailOrderTextbook'; 	  	 //模型名
	public $useTable    = 'parent_account_record_detail_order_textbooks';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 财务记录详情订单（出账）-教材详情表
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-25 20:30
	 * ------------------------------------------------------------
	 */
	public function getParentAccountRecordDetailOrderTextbookByOrderId($order_id){
		$sql  = "SELECT `id` FROM `finance_center`.`parent_account_record_detail_order_textbooks` AS `ParentAccountRecordDetailOrderTextbook` WHERE `order_id`='{$order_id}'";
		return $this->query($sql);
	}
}