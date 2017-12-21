/<?php
/**
 * 账户记录详情—充值（进账）表模型
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
class ParentAccountRecordDetailRecharge extends AppModel {
	public $name 	    = 'ParentAccountRecordDetailRecharge'; 	  	 //模型名
	public $useTable    = 'parent_account_record_detail_recharges';  	 //模型使用的数据表
	public $useDbConfig = 'finance_center'; //使用的数据库连接

	/**
	 * 账户记录详情—充值（进账）表
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-05 22:38
	 * ------------------------------------------------------------
	 */
	public function getParentAccountRecordDetailRechargeByAccountRecordId($id){
		$sql  = " SELECT `id`  FROM `finance_center`.`parent_account_record_detail_recharges` ";
		$sql .= " WHERE account_record_id='{$id}' ";
		return $this->query($sql);
	}
}