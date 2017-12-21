<?php
/**
 * 家长财务记录详情订单详情表【活动详情】表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-11-22 14:35
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class ParentAccountRecordDetailOrderActivity extends AppModel {
	public $name 	    = 'ParentAccountRecordDetailOrderActivity'; 	  	 //模型名
	public $useTable    = 'parent_account_record_detail_order_activities';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 获取所有活动订单
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-11-22 14:35
	 * ------------------------------------------------------------
	 */
	public function getParentAccountRecordDetailOrderActivity() {
		$sql  = "SELECT `id`, `order_id`, `merchant_id`, `platform_id`, `business_type`, `sign_up_channel`, `parent_id`, `parent_name`, `goods_id`, `total_amount`, `status`, `sign_date`, `sign_channel`, `creator_id`, `created`, `modifier_id`, `modified`, `is_usable`, `is_delete` FROM `finance_center`.`parent_account_record_detail_order_activities` ";
		return $this->query($sql);
	}
}