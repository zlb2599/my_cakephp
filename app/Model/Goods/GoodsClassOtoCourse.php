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
 * @date 2017-10-19 13:10
 * @author liuhefei<liuhefei@xiaohe.com>
 */
class GoodsClassOtoCourse extends AppModel {
	public $name 	    = 'GoodsClassOtoCourse'; 	  //模型名
	public $useTable    = 'gc_goods_class_oto_courses'; //模型使用的数据表
	public $useDbConfig = 'goods_center'; //使用的数据库连接
}