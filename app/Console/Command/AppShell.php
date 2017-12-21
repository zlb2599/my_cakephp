<?php
/**
 * AppShell file
 * PHP 5
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Shell', 'Console');

/**
 * Application Shell
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 * @package       app.Console.Command
 */
define('PS', PATH_SEPARATOR);
define('LOGS_PATH', sprintf('%s/tmp/logs/%s/', str_replace('\\', '/', dirname(dirname(dirname(__FILE__)))), date('Ym')));

class AppShell extends Shell
{
    /**
     * 调试方法
     * ----------------------------------------------------------
     * @access public
     * ----------------------------------------------------------
     * @param mixed  $data 要调试的数据
     * @param int    $type 调试模式（1：打印 2：带数据类型打印 3：写文件不追加 4：写文件追加）
     * @param string $file_name 文件名称
     * ----------------------------------------------------------
     * @return null
     * ----------------------------------------------------------
     * @author biguangfu <biguangfu@xiaohe.com>
     * ----------------------------------------------------------
     * @date 2016-03-01 10:15
     * ----------------------------------------------------------
     */
    protected function debug($data, $type = 1, $file_name = 'debug.log')
    {
        switch ($type) {
            case 1:
                echo '<pre>';
                print_r($data);
                echo '</pre>';
                break;
            case 2:
                echo '<pre>';
                var_dump($data);
                echo '</pre>';
                break;
            default :
                $enter     = (PS == ';')?"\n":"\r\n";
                $file_path = sprintf('%s%s', LOGS_PATH, $file_name);
                if (!file_exists(dirname($file_path))) mkdir(dirname($file_path), 0755, true);
                $date_time = sprintf('#DATETIME: %s%s', date('Y-m-d H:i:s'), $enter);
                if (is_numeric($data) || is_string($data)) {
                    $str_data = sprintf('%s%s%s%s', $date_time, $data, $enter, $enter);
                } else {
                    $str_data = sprintf('%s%s%s%s', $date_time, var_export($data, true), $enter, $enter);
                }
                if ($type == 3) {
                    file_put_contents($file_path, $str_data);
                } else {
                    file_put_contents($file_path, $str_data, FILE_APPEND);
                }
                break;
        }
    }

    /**
     * 获取UUID
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @return string
     * ------------------------------------------------------------
     * @author wangjunjie <wangjunjie@longxiao.com>
     * ------------------------------------------------------------
     * @date 2014-11-26 16:59
     * ------------------------------------------------------------
     */
    protected function getUuid()
    {
        return md5(hash('ripemd128', md5(uniqid($this->getRandStr(10, '1,2,3,4'), true)).microtime())); //返回生成的UUID
    }


    /**
     * 随机获取一个字符串
     * ------------------------------------------------------------
     * @access private
     * ------------------------------------------------------------
     * @param  int    $length 长度
     * @param  string $type 类型
     * @return string
     * ------------------------------------------------------------
     * @author wangjunjie <wangjunjie@longxiao.com>
     * ------------------------------------------------------------
     * @date 2014-11-26 17:04
     * ------------------------------------------------------------
     */
    protected function getRandStr($length, $type = '1')
    {
        //数据初始化
        $tmp_arr  = array(); //临时数组
        $tmp_type = explode(',', $type); //处理字符串
        $arr[1]   = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); //数字
        $arr[2]   = array(')', '!', '@', '#', '$', '%', '^', '&', '*', '('); //数字上的字符
        $arr[3]   = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'); //小写字母
        $arr[4]   = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); //大写字母
        //模式处理
        foreach ($tmp_type as $val) {
            if (isset($arr[$val])) {
                $tmp_arr = array_merge($tmp_arr, $arr[$val]); //合并数组
            }
        }
        //生成字符串
        $tmp_arr_len = (count($tmp_arr) - 1);
        shuffle($tmp_arr);
        $str = ''; //数组长度、打乱顺序、初始化返回字符串
        for ($i = 0; $i < $length; $i++) {
            $str .= $tmp_arr[mt_rand(0, $tmp_arr_len)]; //拼装字符串
        }

        //返回字符串
        return $str; //返回字符串
    }

}
