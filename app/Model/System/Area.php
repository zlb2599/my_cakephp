<?php
/**
 * 获取地区信息
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-30 10:56
 * @author houguopeng<houguopeng@xiaohe.com>
 */
class Area extends AppModel {
	public $name 	    = 'Area'; 	  	 //模型名
	public $useTable    = 'uc_areas';  	 //模型使用的数据表
	public $useDbConfig = 'system_center'; //使用的数据库连接

	/**
	 * 获取城市
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author houguopeng<houguopeng@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-30 10:56
	 * ------------------------------------------------------------
	 */
	public function getCity($citys = '', $notcitys = '') {
		$where = '';
		$sql   = "SELECT `id`,`name`,`parent_id`,`level` FROM `system_center`.`uc_areas` ";

		//循环显示的城市
		if (!empty($citys)) {
			foreach ($citys as $key => $value) {
				$where .= " OR name LIKE '%{$value}%'";				
			}
			$where = ' AND ('.ltrim($where, ' OR ').')';
		}
		//循环不显示的城市
		if (!empty($notcitys)) {
			foreach ($notcitys as $keynot => $valuenot) {
				$where .= " AND name NOT LIKE '%{$valuenot}%'";
			}
			$where = ' AND ('.ltrim($where, ' AND ').')';
		}

		$sql     .= 'WHERE 1=1 AND `is_delete`=2 AND level = 2'.$where;
		$city_ids = $this->query($sql);

		//循环赋值省份、城市
		$city_id     = array();
		$province_id = array();
		foreach ($city_ids as $key_ids => $value_ids) {
			$city_id[] 								   = $value_ids['uc_areas']['id'];
			$province_id[$value_ids['uc_areas']['id']] = $value_ids['uc_areas']['parent_id'];
		}

		//通过城市id查询省份
		$district_id = '';
		if (!empty($city_id)) {
			$district_id = $this->getDistrict($city_id);
		}

		//组合数据完成 省、市、区 数组
		$region = array();
		if (!empty($district_id)) {
			foreach ($district_id as $key_re => $value_re) {
				$region[$key_re]['province_id'] = $province_id[$value_re['uc_areas']['parent_id']];
				$region[$key_re]['city_id']     = $value_re['uc_areas']['parent_id'];
				$region[$key_re]['district_id'] = $value_re['uc_areas']['id'];
			}
		}

		return $region;
	}

	/**
	 * 获取城市
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author houguopeng<houguopeng@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-30 10:56
	 * ------------------------------------------------------------
	 */
	public function getDistrict($city_ids = '', $notcity_ids = '') {
		$where = '';
		$sql   = "SELECT `id`,`name`,`parent_id`,`level` FROM `system_center`.`uc_areas` ";

		if (!empty($city_ids)) {
			$where .= " AND `parent_id` IN ('".implode("','", $city_ids)."') ";
		}

		$sql .= 'WHERE 1=1 AND `is_delete`=2'.$where;

		return $this->query($sql);
	}

	/**
	 * 获取区域实体
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author houguopeng<houguopeng@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-30 10:56
	 * ------------------------------------------------------------
	 */
	public function getAreaEntity($id){
		$where = '';
		$sql   = "SELECT `id`,`name`,`parent_id`,`level` FROM `system_center`.`uc_areas` WHERE id='{$id}' ";
		$data = $this->query($sql);
		return $data['0']['uc_areas'];
	}
}