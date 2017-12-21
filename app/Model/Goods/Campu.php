<?php
/**
 * 分校模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-11-04 18:31
 * @author xinjianhua<xinjianhua@xiaohe.com>
 */
class Campu extends AppModel
{
    public $name        = 'Campu'; //模型名
    public $useTable    = 'gc_campus'; //模型使用的数据表
    public $useDbConfig = 'goods_center'; //使用的数据库连接

    /**
     * 获取商家分校
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @param $merchant_id
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-04 18:31
     * ------------------------------------------------------------
     */
    public function getCampus($merchant_id)
    {
        $sql = " SELECT `id`,`name` FROM `goods_center`.`gc_campus` ";
        $sql .= "WHERE `merchant_id`='{$merchant_id}' AND `is_usable` = 1 AND `is_delete` = 2 ";

        return $this->query($sql);
    }

    /**
     * [getCampusList description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function getCampusList(array $data)
    {
        $mids = $data['mids']; // 商家 IDS
        $sql  = '';
        $sql .= 'SELECT a.id,a.browse_number,a.merchant_id,a.platform_id,';
        $sql .= 'SUM(c.saled) saled,SUM(c.pre_saled) AS pre_saled ';
        $sql .= 'FROM goods_center.gc_campus AS a ';
        $sql .= 'LEFT JOIN goods_center.gc_goods_class_otms AS b ON b.campus_id = a.id ';
        $sql .= 'LEFT JOIN goods_center.gc_goods AS c ON c.id = b.goods_id ';
        $sql .= 'WHERE TRUE ';
        $sql .= "AND a.is_usable = '1' ";
        $sql .= "AND a.is_delete = '2' ";
        $sql .= "AND a.merchant_id IN ({$mids}) ";
        $sql .= 'GROUP BY a.id';
        $entity = $this->query($sql);

        if ($entity) {
            $array = [];
            foreach ($entity as $key => $value) {
                $array[$key] = array_merge($value['a'], $value[0]);
            }

            return $array;
        }

        return $entity;
    }
}
