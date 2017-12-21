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
class ClueParent extends AppModel {
	public $name        = 'ClueParent'; 	  	 //模型名
	public $useTable    = 'bc_clue_parents';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接

	/**
	 * 获取线索实体
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-11-22 14:57
	 * ------------------------------------------------------------
	 */
	public function getClueParentEntity($conditions = array()){
		$sql = "SELECT `id`, `platform_id`, `merchant_id`, DECODE(`phone`, 'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') AS `phone`, `type`, `creator_id`, `created` FROM `business_center`.`bc_clue_parents` WHERE TRUE ";
		if (isset($conditions['merchant_id']) && !empty($conditions['merchant_id'])) {
			$sql .= " AND `merchant_id`='{$conditions['merchant_id']}' ";
		}
		if (isset($conditions['phone']) && !empty($conditions['phone'])) {
			$sql .= " AND `phone` = ENCODE('{$conditions['phone']}', 'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') ";
		}
		if (isset($conditions['type']) && !empty($conditions['type'])) {
			$sql .= " AND `type`='{$conditions['type']}' ";
		}
		$sql .= " AND " . mt_rand(10000000, 99999999);
		$result = $this->query($sql);
		$entity = array();
		if (isset($result[0])) {
			$entity = array_merge($result[0]['bc_clue_parents'], $result[0][0]);
		}
		return $entity;
	}

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
	public function addClueParent($data){
		$sql = " INSERT INTO `business_center`.`bc_clue_parents` SET ";
		$sql .= " `id`='{$data['id']}', ";
		$sql .= " `platform_id`='{$data['platform_id']}', ";
		$sql .= " `merchant_id`='{$data['merchant_id']}', ";
		$sql .= " `phone`=ENCODE('{$data['phone']}', 'I8feVXtTO0mv42QB9omOjvV9JyunNrZb'), ";
		$sql .= " `type`='{$data['type']}', ";
		$sql .= " `creator_id`='{$data['creator_id']}', ";
		$sql .= " `created`='{$data['created']}' ";
		$this->query($sql);
		return $sql;
	} 
}