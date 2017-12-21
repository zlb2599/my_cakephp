<?php
/**
 * 一对多班级模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-26 18:10
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class GoodsClassOtm extends AppModel {
	public $name 	    = 'GoodsClassOtm'; 	  //模型名
	public $useTable    = 'gc_goods_class_otms';  	  //模型使用的数据表
	public $useDbConfig = 'goods_center'; //使用的数据库连接

	/**
	 * 更新课程综合排名
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @param $goods_id string 商品ID
	 * ------------------------------------------------------------
	 * @param $sort_val int 排序值
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-26 18:11
	 * ------------------------------------------------------------
	 */
	public function updateComprehensiveSort($goods_id, $sort_val) {
		$sql = "UPDATE `goods_center`.`gc_goods_class_otms` SET `comprehensive_sort_value` = '{$sort_val}' WHERE `goods_id` = '{$goods_id}'";
		return $this->query($sql);
	}

	/**
	 * [getOtmInfo description]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function getOtmInfo(array $data)
	{
		$sql = '';
		$sql .= 'SELECT a.goods_id,a.campus_id FROM goods_center.gc_goods_class_otms AS a WHERE TRUE ';
		if (!empty($campus_id = $data['id'])) {
			$sql .= "AND a.campus_id = '{$campus_id}' ";
		}
		$entity = $this->query($sql);

		if ($entity) {
			$array = [];
			foreach ($entity as $key => $val) {
				$array[$key] = $val['a'];
			}

			return $array;
		}

		return $entity;
	}
}