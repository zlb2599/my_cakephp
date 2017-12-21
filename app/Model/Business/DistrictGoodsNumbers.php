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
class DistrictGoodsNumbers extends AppModel {
	public $name 	    = 'DistrictGoodsNumbers'; 	  	 //模型名
	public $useTable    = 'gc_district_goods_numbers';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接

    /**
     * 插入缓存数据
     *
     * @return void
     */
	public function insertData($sql = '', $is_clean_data=false)
    {
        if ($sql) {
            if($is_clean_data){
                // 请空表
                $status = $this->truncateTable();
            }
            
            // 插入数据
            $this->query($sql);
        } else {
            return false;
        }
    }

    /**
     * 插入数据之前，将原有的数据清空
     *
     * @return boolean 
     */
    private function truncateTable()
    {
        
        $sql = "DELETE FROM business_center.gc_district_goods_numbers";
        $result = $this->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}