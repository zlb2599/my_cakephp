<?php
/**
 * 商品营销表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-06-05 13:39
 * @author houguoepng<houguoepng@xiaohe.com>
 */
class GoodsMarketing extends AppModel {
    public $name 	    = 'GoodsMarketing'; 	  	 //模型名
    public $useTable    = 'bc_goods_marketings';  	 //模型使用的数据表
    public $useDbConfig = 'business_center'; //使用的数据库连接
    public $page_size   = 11; //页数基础参数 10+1

    /**
     * 获取全部有效活动
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author houguoepng<houguoepng@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2017-06-05 13:41
     * ------------------------------------------------------------
     */
    public function getGoodsMarketing($date ='', $page) {

        $sql  = "SELECT a.`id`,a.`type`,a.`merchant_id`,a.`goods_id`,a.`price` ";
        $sql .= 'FROM `business_center`.`bc_goods_marketings` as a ';
        $sql .= 'LEFT JOIN `goods_center`.`gc_goods` as b ON a.goods_id=b.id ';
        $sql .= "WHERE a.`is_delete`='2' AND a.`is_usable` = '1' ";
        $sql .= "AND (b.`use_discount_types` IS NULL OR b.`use_discount_types` = '') ";
        $sql .= " AND a.`start_time` <= '{$date}' AND a.`end_time` >= '{$date}' ORDER BY a.`type`";

        $data      = $this->query($sql);
        //print_r($data );
//$this->debug($data, 4, 'goodsmarketing.log');
        
        $page_size = $this->page_size;
        $result    = [];
        
        foreach ($data as $key => $value) {
            $result[$value['a']['goods_id']][] = $value['a'];
        }

        // $count     = count($data_arr);

        // if ($page<10) {
        //     //$offset = ceil($count/($page_size-$page));
        //     $offset = $count;
        //     $result = array_slice($data_arr, 0, $offset);
        // } else {
        //     $result = array_slice($data_arr, 0);
        // }
        
        return $result;
    }
}
