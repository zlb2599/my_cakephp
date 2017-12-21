<?php
/**
 * 商品模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-26 17:50
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class Goods extends AppModel
{
    public $name        = 'Goods'; //模型名
    public $useTable    = 'gc_goods'; //模型使用的数据表
    public $useDbConfig = 'goods_center'; //使用的数据库连接
    public $page_size   = 11; //页数基础参数 10+1

    /**
     * 获取课程浏览数及剩余名额
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author biguangfu<biguangfu@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-09-26 17:53
     * ------------------------------------------------------------
     */
    public function getGoodsBrowserNumberAndSurplusQuota()
    {
        $sql = "SELECT `Goods`.`id`, `GoodsClassOtm`.`browse_number`, (`Goods`.`total`-`Goods`.`saled`) AS `surplus_quota` ";
        $sql .= "FROM `goods_center`.`gc_goods` AS `Goods` ";
        $sql .= "LEFT JOIN `goods_center`.`gc_goods_class_otms` AS `GoodsClassOtm` ";
        $sql .= "ON `Goods`.`id` = `GoodsClassOtm`.`goods_id` ";
        $sql .= "WHERE `GoodsClassOtm`.`is_enforce` = '1' ";
        $sql .= "AND `GoodsClassOtm`.`finish_lesson` = '0' ";
        $sql .= "AND `GoodsClassOtm`.`is_shelf` = '1' ";
        $sql .= "AND `Goods`.`merchant_id` != 'd796836ecf80ec5eb669a3f96abcaff4' ";
        $sql .= "AND `Goods`.`goods_type_id` = '519451b050d44582ab3e08430a00c776' ";
        $sql .= "AND `Goods`.`is_usable` = '1' ";
        $sql .= "AND `Goods`.`is_delete` = '2' ";
        return $this->query($sql);
    }

    /**
     * 获取商家所有教学用品
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @param $merchant_id
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-04 18:19
     * ------------------------------------------------------------
     */
    public function getTextbook($merchant_id)
    {
        $sql = " SELECT `id`,`name`,`cost`,`total` FROM `goods_center`.`gc_goods` ";
        $sql .= "WHERE `merchant_id`='{$merchant_id}' AND `goods_type_id`='519451b050d44582ab3e08430a00c774' ";
        $sql .= "AND `is_usable` = 1 AND `is_delete` = 2 ";

        return $this->query($sql);
    }

    /**
     * 获取区域下的所有课程
     */
    public function getDistrictGoods()
    {

        $sql = 'SELECT goods.id, goods.merchant_id, campus.district_id, campus.city_id, campus.platform_id, goods.platform_id
                FROM goods_center.gc_goods AS goods
                INNER JOIN goods_center.gc_goods_class_otms AS otms ON goods.id = otms.goods_id
                INNER JOIN goods_center.gc_campus AS campus ON campus.id = otms.campus_id
                WHERE goods.is_delete = "2"
                AND goods.is_usable = "1"
                AND otms.finish_lesson < otms.lesson_total
                AND otms.is_enforce = "1"
                AND goods.total > goods.saled ';

        // 执行查询操作
        return $this->query($sql);
    }

    /**
     * 获取课程对应套餐
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author houguopeng<houguopeng@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2017-06-05 17:39
     * ------------------------------------------------------------
     */
    public function getGoodsPackage($date = '', $page)
    {

        $sql = ' SELECT p.`goods_id`,g.`end_date`,  p.`sub_goods_id` FROM `goods_center`.`gc_goods_class_otm_packages` AS p ';
        $sql .= ' LEFT JOIN `goods_center`.`gc_goods` AS g ON p.`goods_id` = g.`id` ';
        $sql .= ' LEFT JOIN `goods_center`.`gc_goods` AS h ON p.`sub_goods_id` = h.`id`';
        $sql .= " WHERE p.`is_usable` = 1 AND p.`is_delete` = 2 AND g.`end_date` >= '{$date}'";
        $sql .= " AND (h.`use_discount_types` IS NULL OR h.`use_discount_types` ='')";
        $sql .= ' GROUP BY p.`sub_goods_id`';

        $data = $this->query($sql);

        // $count     = count($data);
        // $page_size = $this->page_size;
        $result = [];

        foreach ($data as $key => $value) {
            $result[$value['p']['sub_goods_id']][] = $value['p'];
        }

        // $count     = count($data_arr);

        // if ($page<10) {
        //     $offset = ceil($count/($page_size-$page));
        //     $result = array_slice($data_arr, 0, $offset);
        // } else {
        //     $result = array_slice($data_arr, 0);
        // }

        return $result;
    }

    /**
     * 获取课程对应连报优惠
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author houguopeng<houguopeng@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2017-06-06 14:39
     * ------------------------------------------------------------
     */
    public function getPlansDiscount($date = '', $page)
    {

        $sql = 'select a.`name`,b.`goods_id` from `business_center`.`bc_discount_merchant_plans` as a ';
        $sql .= 'left join goods_center.gc_goods_discount_plans as b ON  a.id=b.discount_merchant_plan_id ';
        $sql .= 'LEFT JOIN goods_center.gc_goods AS c ON b.goods_id = c.id ';
        $sql .= "WHERE a.is_delete='2' AND a.is_usable='1' AND a.start_date<='" . $date . "' ";
        $sql .= "AND (c.`use_discount_types` IS NULL OR c.`use_discount_types` = '') ";
        $sql .= "AND a.end_date>='" . $date . "' AND b.goods_id !='' GROUP BY b.`goods_id` ";

        $data = $this->query($sql);

        // $count     = count($data);
        // $page_size = $this->page_size;

        // $offset = ceil($count/($page_size-$page));

        // $result = array_values(array_slice($data, 0, $offset));
        return $data;
    }

    /**
     * Get merchant column information.
     *
     * @param  array $array
     * @return int
     */
    public function getColumnInfo(array $array, $column, $isDelete = false)
    {
        $condition = array_map(function ($key, $val) {
            if ($key === 'type_id in' || $key === 'data_enter_type in') {
                if (is_array($val)) {
                    $val = "'" . implode("','", $val) . "'";
                }

                return "AND {$key} ({$val})";
            } else {
                return "AND {$key}'{$val}' ";
            }
        }, array_keys($array), array_values($array));
        $condition = implode('', $condition);

        if ($isDelete) {
            $condition .= "AND is_delete='2' ";
        }

        $sql = '';
        $sql .= "SELECT {$column} ";
        $sql .= "FROM goods_center.gc_goods ";
        $sql .= "WHERE TRUE {$condition}";
        $result = $this->query($sql);

        return $result;
    }

    /**
     * 描述：获取课程剩余可卖数据
     * @param
     * @return array
     * @author xuxiongzi <xuxiongzi@xiaohe.com>
     */
    public function getSurplus() {

        $sql = " SELECT id,surplus FROM (SELECT a.id, ";
        $sql .= " CASE WHEN (IFNULL(a.total-a.saled ,0)) < 0 THEN 0 ELSE (IFNULL(a.total-a.saled ,0)) END AS surplus ";
        $sql .= " FROM `goods_center`.`gc_goods` a ";
        $sql .= " LEFT JOIN `goods_center`.gc_goods_class_otms b ON a.id = b.goods_id ";
        $sql .= " WHERE a.`is_usable` = 1 AND a.`is_delete` = 2 AND b.is_enforce BETWEEN '1' AND '4' ";
        $sql .= ")tmp limit 1";

        $entity = $this->query($sql);

        if ($entity) {
            $array = [];
            foreach ($entity as $key => $val) {
                $array[$key] = $val['tmp'];
            }

            return $array;
        }

        return $entity;
    }
}
