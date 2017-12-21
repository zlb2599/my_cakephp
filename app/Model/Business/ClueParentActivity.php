<?php
/**
 * 线索-家长表
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-11-22 14:57
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class ClueParentActivity extends AppModel {
	public $name        = 'ClueParentActivity'; 	  	 //模型名
	public $useTable    = 'bc_clue_parent_activities';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接

	/**
	 * 添加线索
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-11-22 14:57
	 * ------------------------------------------------------------
	 */
	public function addClueParentActivity($data){
		$sql = " INSERT INTO `business_center`.`bc_clue_parent_activities` SET ";
		$sql .= " `id`='{$data['id']}', ";
		$sql .= " `clue_id`='{$data['clue_id']}', ";
		$sql .= " `parent_id`='{$data['parent_id']}', ";
		$sql .= " `parent_name`='{$data['parent_name']}', ";
		$sql .= " `activity_id`='{$data['activity_id']}', ";
		$sql .= " `sign_up_channel`='{$data['sign_up_channel']}', ";
		if (isset($data['sign_date']) && !empty($data['sign_date'])) {
			$sql .= " `sign_date`='{$data['sign_date']}', ";
		}
		if (isset($data['sign_channel']) && !empty($data['sign_channel'])) {
			$sql .= " `sign_channel`='{$data['sign_channel']}', ";
		}
		$sql .= " `creator_id`='{$data['creator_id']}', ";
		$sql .= " `created`='{$data['created']}', ";
		$sql .= " `modifier_id`='{$data['creator_id']}', ";
		$sql .= " `modified`='{$data['created']}' ";
		$this->query($sql);
		return $sql;
	} 
}