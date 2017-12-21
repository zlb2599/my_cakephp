<?php
/**
 * 此定时任务为作业还有15分钟结束时提醒老师批改作业
 * @copyright Copyright 2012-2017, BAONAHAO Software Foundation, Inc. ( http://api.baonahao.com/ )
 * @link http://api.baonahao.com api(tm) Project
 * @author zhanglibo <zhanglibo@xiaohe.com>
 */
App::uses('AppModel', 'Model');
App::uses('Goods', 'Model/Goods');
App::uses('Lesson', 'Model/Goods');
App::uses('PushMessageLog', 'Model/Business');
App::uses('HomeworkBasesModel', 'Model/Business');
App::uses('Employee', 'Model/Member');
$app_path = str_replace('\\', '/', dirname(dirname(dirname(__FILE__))));
require $app_path.'/Vendor/JIguang/JPush.php';
require $app_path.'/Config/JiPush.php';

class TimedTaskHomeworkAnswerPushShell extends AppShell
{
    /**
     * 作业批改提醒
     */
    public function homeworkAnswerNotice()
    {
        global $argv;
        set_time_limit(0);
        ini_set('memory_limit', '2048M');

        $this->pushNotice();
    }

    /**
     * 作业批改提醒推送
     */
    private function pushNotice()
    {
        //模型
        $homework_model = new HomeworkBasesModel();

        /** 获取还有15分钟就要结束的全部作业 */
        $homework_list = $homework_model->getHomeworkAnswered();
        if (empty($homework_list)) return;
        foreach ($homework_list as $key => $value) {
            $push_info = [
                'title'          => '作业通知',//推送标题
                'alert'          => $value['name'],//推送弹出消息
                'content'        => $value['name'],//推送内容
                'alias'          => array($value['member_id']),//推送到那个用户
                //'alias' => ['8fa233ea54af49179b44ce28e01266b4'],
                //极光消息
                'extras_jiguang' => ['homework_id' => $value['id'], 'push_type' => '4'],
                //数据库存储
                'extras'         => json_encode(['homework_id' => $value['id'], 'push_type' => '4']),
                //'merchant_id' => $merchant_id,//推送标题
            ];
            $this->messagePushRecord($push_info);
        }
    }

    //发送推送
    private function messagePushRecord($data)
    {
        //参数
        $content     = getArrVal($data, 'content');
        $alert       = getArrVal($data, 'alert');
        $merchant_id = getArrVal($data, 'merchant_id');
        $alias       = getArrVal($data, 'alias');
        $extras_jg   = getArrVal($data, 'extras_jiguang', '');
        $extras      = getArrVal($data, 'extras', '');
        $title       = getArrVal($data, 'title', '作业提醒');
        $created     = getArrVal($data, 'created', date('Y-m-d H:i:s'));

        //获取机构极光配置
        $config = $this->jgset();

        //极光消息推送
        $push_info = [
            'title'   => $title,//推送标题
            'content' => $content,//推送内容
            'alert'   => $alert,//推送弹出消息
            'alias'   => $alias,//发送的用户
            'extras'  => $extras_jg,
        ];
        $push      = new \JPush($config);
        $sendall   = $push->sendAllDevice($push_info);

        //记录消息内容
        $status = $sendall['http_code'] == 200?1:2;

        $apml['id']            = $this->getUuid();
        $apml['app_type']      = 2;
        $apml['push_type']     = 4;
        $apml['push_title']    = $title;
        $apml['push_content']  = $content;
        $apml['push_alert']    = $alert;
        $apml['push_extras']   = $extras;
        $apml['user_id']       = $alias[0];
        $apml['status']        = $status;
        $apml['created']       = $created;
        $apml['app_key']       = $config['app_key'];
        $apml['master_secret'] = $config['master_secret'];

        $this->addPushMessagelog($apml);
    }

    //添加推送记录

    private function jgset()
    {
        //获取机构极光配置
        $model          = new jiPushConfig();
        $jia_app_key    = $model->jiguangPushConfig();
        $config         = $jia_app_key['zsgj']['aixiao'];
        $config['date'] = date("Y-m-d");

        return $config;
    }

    private function addPushMessagelog($data)
    {
        $key_sql    = '';
        $values_sql = '';

        foreach ($data as $key => $value) {
            $key_sql    .= $key.',';
            $values_sql .= "'".$value."',";
        }
        $key_sql    = rtrim($key_sql, ',');
        $values_sql = rtrim($values_sql, ',');

        $sql = "INSERT INTO `business_center`.`bc_push_message_logs` ({$key_sql}) VALUES({$values_sql})";

        $model  = new PushMessageLog();
        $result = $model->query($sql);

        return $result;
    }

    /**
     * 课程信息
     * @param $goods_id
     * @return array|mixed
     * @author zhanglibo <zhanglibo@xiaohe.com>
     */
    private function getGoodsInfo($goods_id)
    {
        $sql      = "select id,merchant_id,platform_id,name";
        $goods_id = array_map(function ($val)
        {
            return "'{$val}'";
        }, $goods_id);
        $sql      .= " where id in (".join(',', $goods_id).")";

        $model = new Goods();

        $goods = $model->query($sql);
        if (empty($goods))
            return $goods = [];
        $goods = array_column($goods, null, 'id');

        return $goods;


    }

    //获取机构极光配置

    /**
     * 已结束课次
     * @return array|mixed
     * @author zhanglibo <zhanglibo@xiaohe.com>
     */
    private function getOpenLesson()
    {

        $date = date("Y-m-d");

        $field = " id,lesson_num,teacher_id,goods_id ";

        $sql = "SELECT {$field} FROM goods_center.gc_lessons as lessons ";
        $sql .= " WHERE lessons.is_usable='1' AND lessons.is_delete='2' AND lessons.open_date = '{$date}'";
        $sql .= " AND lessons.is_finished='2' ";
        $sql .= " AND lessons.teacher_id <> '' ";
        $sql .= " ORDER BY lessons.class_time ASC ";


        $model  = new Lesson();
        $lesson = $model->query($sql);

        if (empty($lesson)) {
            return [];
        }

        return $lesson;

    }
}