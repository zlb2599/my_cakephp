<?php
/**
 * 评论模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-26 17:00
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class Comment extends AppModel {
	public $name 	    = 'Comment'; 	  	 //模型名
	public $useTable    = 'gc_comments';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接

	/**
	 * 获取课程好评数
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-26 17:01
	 * ------------------------------------------------------------
	 */
	public function getComment() {
		$sql  = "SELECT `goods_id`,COUNT(`id`) AS `total` FROM `business_center`.`gc_comments` ";
		$sql .= "WHERE ROUND((`class_effect_score`+`teaching_environment_score`+`service_attitude_score`)/3, 2) >= 4.5 ";
		$sql .= "AND `is_usable`=1 AND `is_delete`=2 GROUP BY `goods_id`";
		return $this->query($sql);
	}

	/**
	 * [getCommentWithCampus description]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function getCommentWithCampus(array $data)
	{
		$cids = $data['campus_id']; // 校区 IDS
		$cids = "'" . implode("','", (array)$cids) . "'";
		$sql = $field = '';
		$field .= 'count(id) as count,COUNT(DISTINCT parent_id) AS comment_parent_num,';
		$field .= 'SUM(class_effect_score)/count(id) as class_effect_score,';
		$field .= 'SUM(teaching_environment_score)/count(id) as teaching_environment_score,';
		$field .= 'SUM(service_attitude_score)/count(id) as service_attitude_score,';
		$field .= 'SUM(class_effect_score+teaching_environment_score+service_attitude_score)/(3*count(id))';
		$field .= ' AS comment_score,campus_id,teacher_id';
		$sql .= "SELECT {$field} ";
		$sql .= "FROM `business_center`.`gc_comments` ";
		$sql .= "WHERE TRUE AND campus_id IN({$cids}) ";
		$sql .= "AND `is_usable`='1' AND `is_delete`='2' AND created <= NOW()";
		$entity = $this->query($sql);

		if ($entity) {
			$array = [];
			foreach ($entity as $key => $value) {
				$array = array_merge($value[0], $value['gc_comments']);
			}
			return $array;
		}

		return $entity;
	}
}