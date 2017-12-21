<?php
/**
 * 课次
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-01-22 13:17
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class Lesson extends AppModel {
	public $name 	    = 'Lesson'; 	  //模型名
	public $useTable    = 'gc_lessons';  	  //模型使用的数据表
	public $useDbConfig = 'goods_center'; //使用的数据库连接

	/**
	 * 获取课次
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @param $goods_id string 商品ID
	 * ------------------------------------------------------------
	 * @param $sort_val int 排序值
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-01-22 13:17
	 * ------------------------------------------------------------
	 */
	public function getLesson($condition){
		$sql = "select `id`,`lesson_num` from `goods_center`.`gc_lessons` as lesson where `is_usable`=1 AND `is_delete`=2";
		if (isset($condition['goods_id']) && !empty($condition['goods_id'])) {
			$goods_id = implode("','", (array)$condition['goods_id']);
			$sql .= " AND `goods_id` IN ('{$goods_id}') ";
		}
		$sql .= 'order by lesson_num';
		return $this->query($sql);
	}

	/**
	 * 获取当天可上课课次数据
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @param $data array
	 * ------------------------------------------------------------
	 * @reutn $data_result
	 * ------------------------------------------------------------
	 * @author houguoopeng<houguoopeng@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-08-18 11:41
	 * ------------------------------------------------------------
	 */
	public function getSameDayLesson($type = 1, $data = array()){
		//预设参数
		$date      = date('Y-m-d');
		//$date      = '2017-08-18';
		$date_time = date('Y-m-d H:i');
		//提前时间
		$start     = 105*60;
        $end       = 95*60;
		// $start   = 60*60;
  //       $end     = 50*60;
        $lesson    = [];
		//数据库中具体时间获取
		$open_date_time_one = " AND FROM_UNIXTIME((UNIX_TIMESTAMP(concat(open_date,' ',SUBSTRING(class_time, 1, 5)))-{$start}),'%Y-%m-%d %H:%i')<='{$date_time}'";
		$open_date_time_two = " AND FROM_UNIXTIME((UNIX_TIMESTAMP(concat(open_date,' ',SUBSTRING(class_time, 1, 5)))-{$end}),'%Y-%m-%d %H:%i')>='{$date_time}' ";

		//$sql = "SELECT  `id`,`lesson_num`,`teacher_id`,`open_date`,`class_time`,`merchant_id`,`platform_id`,`goods_id`,`lesson_num` from `goods_center`.`gc_lessons` as lesson where `is_usable`=1 AND `is_delete`=2 AND `open_date`='{$date}' AND teacher_id<>'' ";
		$sql = "SELECT  COUNT(`id`) as count,`teacher_id` from `goods_center`.`gc_lessons` as lesson where `is_usable`=1 AND `is_delete`=2 AND `open_date`='{$date}' AND teacher_id<>'' AND is_finished='2'";
		if ($type == 2) {
			$sql .= $open_date_time_one.$open_date_time_two;
		}
		
		$sql .= ' GROUP BY teacher_id';

		$lesson_all = $this->query($sql);

		foreach ($lesson_all as $key => $value) {
			$lesson[$key]['teacher_id'] = $value['lesson']['teacher_id'];
			$lesson[$key]['count'] = $value[0]['count'];
		}

		return $lesson;
	}
}