<?php
/**
 * 作业基本信息
 * @copyright Copyright 2012-2017, BAONAHAO Software Foundation, Inc. ( http://api.baonahao.com/ )
 * @link http://api.baonahao.com api(tm) Project
 * @author zhanglibo <zhanglibo@xiaohe.com>
 */


class HomeworkBasesModel extends AppModel
{
    public $name 	         = 'HomeworkBasesModel'; 	  	 //模型名
    public $useTable        = 'bc_homework_bases';  	 //模型使用的数据表
    public $useDbConfig     = 'business_center';        //使用的数据库连接

    /**
     * 描述：获取已经回答过的当天的作业列表
     * @param
     * @return array
     * @author xuxiongzi <xuxiongzi@xiaohe.com>
     */
    public function getHomeworkAnswered() {

        $sql = " SELECT a.id,a.lesson_id ,a.goods_id,a.`count_submit` ,a.deadline , ";
        $sql .= " CONCAT(b.name,\"第\",c.lesson_num,\"节课作业即将结束,已有\",a.`count_submit`,\"人提交,点击查看\") AS name, ";
        $sql .= " d.`member_id` ";
        $sql .= " FROM `business_center`.`bc_homework_bases`a ";
        $sql .= " LEFT JOIN `goods_center`.gc_goods b ON a.goods_id = b.id ";
        $sql .= " LEFT JOIN goods_center.gc_lessons c ON a.lesson_id = c.id ";
        $sql .= " LEFT JOIN `member_center`.`mc_employees` d ON a.`creator_id` = d.id ";
        $sql .= " WHERE a.`is_usable` = 1 AND a.`is_delete` = 2 AND a.`count_submit` <> 0 ";
        $sql .= " AND  UNIX_TIMESTAMP(a.deadline) - UNIX_TIMESTAMP() > 0 ";
        $sql .= " AND  UNIX_TIMESTAMP(a.deadline) - UNIX_TIMESTAMP() <= 15 * 60 ";

        $result = $this->query($sql);
        return empty($result) ? [] : $result;

    }

    /**
     * 描述：获取刚结束5分钟内没有发作业的课次
     * @param
     * @return array
     * @author xuxiongzi <xuxiongzi@xiaohe.com>
     */
    public function getLessons() {

        $sql = " SELECT ";
        $sql .= " a.`open_date`, ";
        $sql .= " a.`class_time`, ";
        $sql .= " a.`teacher_id`, ";
        $sql .= " b.`member_id`, ";
        $sql .= " CONCAT(c.name,\"第\",a.`lesson_num`,\"节课已经结束!请为孩纸们安排课后作业巩固学习效果哟~\") AS NAME ";
        $sql .= " FROM `goods_center`.`gc_lessons` a ";
        $sql .= " LEFT JOIN `member_center`.`mc_employees` b ON a.`teacher_id` = b.`id` ";
        $sql .= " LEFT JOIN `goods_center`.`gc_goods` c ON c.id = a.`goods_id` ";
        $sql .= " LEFT JOIN `business_center`.`bc_homework_bases` e ON a.id = e.`lesson_id` ";
        $sql .= " WHERE a.`is_delete` = 2 AND a.`is_usable` = 1 ";
        $sql .= " AND TO_DAYS(a.`open_date`) = TO_DAYS(NOW()) ";
        $sql .= " AND a.`is_finished` = 1 ";
        $sql .= " AND e.`lesson_id` IS NULL ";
        $sql .= " AND b.`member_id` IS NOT NULL ";
        $sql .= " AND  UNIX_TIMESTAMP(CONCAT(a.open_date,' ',SUBSTRING(a.class_time, 6, 11))) - UNIX_TIMESTAMP() > 0 ";
        $sql .= " AND  UNIX_TIMESTAMP(CONCAT(a.open_date,' ',SUBSTRING(a.class_time, 6, 11))) - UNIX_TIMESTAMP() <= 5 * 60 ";

        $result = $this->query($sql);
        return empty($result) ? [] : $result;

    }

}