<?php

/**
 * 描述：redis引擎
 *
 * @copyright Copyright 2012-2016, BAONAHAO Software Foundation, Inc. ( http://api.baonahao.com/ )
 * @link http://api.baonahao.com api(tm) Project
 * @date 2017/12/6 17:30
 * @author xuxiongzi <xuxiongzi@xiaohe.com>
 */
$app_path = str_replace('\\', '/', dirname(dirname(dirname(__FILE__))));
require $app_path.'/app/Config/RedisConfig.php';
class RedisUtils
{
    /**
     * Redis wrapper.
     *
     * @var Redis
     */
    private $_Redis = null;


    //redis配置
    /**
    * Connects to a Redis server
    * 构造函数私有化确保单例
    */
    private function __construct() {

        $conf = new RedisConfig();
        $conf = $conf->getConfig();
        $return = false;
        try {
            $this->_Redis = new Redis();
            if (empty($conf['persistent'])) {
                $return = $this->_Redis->connect($conf['server'], $conf['port'], $conf['timeout']);
            } else {
                $return = $this->_Redis->pconnect($conf['server'], $conf['port'], $conf['timeout']);
            }
        } catch (RedisException $e) {
            return false;
        }
        if ($return && $conf['password']) {
            $return = $this->_Redis->auth($conf['password']);
        }
        if(!$return){
            exit('Could not connect redis');
        }
    }


    //克隆函数私有化，确保单例
    private function __clone(){ }

    /** 实例 */
    private static $instance = null;

    /**
     * 获取实例
     *
     * @return object
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Write data for key into cache.
     *
     * @param string $key Identifier for the data
     * @param mixed $value Data to be cached
     * @param integer $duration How long to cache the data, in seconds
     * @return boolean True if the data was successfully cached, false on failure
     */
    public function write($key, $value, $duration) {
            return $this->_Redis->set($key, $value);
    }

    /**
     * Read a key from the cache
     *
     * @param string $key Identifier for the data
     * @return mixed The cached data, or false if the data doesn't exist, has expired, or if there was an error fetching it
     */
    public function read($key) {
        $value = $this->_Redis->get($key);
        return $value;
    }

    /**
     * Increments the value of an integer cached key
     *
     * @param string $key Identifier for the data
     * @param integer $offset How much to increment
     * @return New incremented value, false otherwise
     * @throws CacheException when you try to increment with compress = true
     */
    public function increment($key, $offset = 1) {
        return (int)$this->_Redis->incrBy($key, $offset);
    }

    /**
     * Decrements the value of an integer cached key
     *
     * @param string $key Identifier for the data
     * @param integer $offset How much to subtract
     * @return New decremented value, false otherwise
     * @throws CacheException when you try to decrement with compress = true
     */
    public function decrement($key, $offset = 1) {
        return (int)$this->_Redis->decrBy($key, $offset);
    }

    /**
     * Delete a key from the cache
     *
     * @param string $key Identifier for the data
     * @return boolean True if the value was successfully deleted, false if it didn't exist or couldn't be removed
     */
    public function delete($key) {
        return $this->_Redis->delete($key) > 0;
    }

    //记录错误日志
    function errorLog($file, $sql){
        $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $file . '_' . date('Ymd') . '.log';
        file_put_contents($path, '-- ' . date('Y-m-d H:i:s') . "\r\n" . $sql . "\r\n", FILE_APPEND);
    }

    //记录成功日志
    function successLog($file, $sql){
        $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $file . '_' . date('Ymd') . '.log';
        file_put_contents($path, '-- ' . date('Y-m-d H:i:s') . "\r\n" . $sql . "\r\n", FILE_APPEND);
    }

}