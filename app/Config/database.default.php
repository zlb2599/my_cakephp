<?php

/**
 * This is core configuration file.
 * Use it to configure core behaviour of Cake.
 * PHP 5
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 * Database configuration class.
 * You can specify multiple configurations for production, development and testing.
 * datasource => The name of a supported datasource; valid options are as follows:
 *        Database/Mysql        - MySQL 4 & 5,
 *        Database/Sqlite        - SQLite (PHP5 only),
 *        Database/Postgres    - PostgreSQL 7 and higher,
 *        Database/Sqlserver    - Microsoft SQL Server 2005 and higher
 * You can add custom database datasources (or override existing datasources) by adding the
 * appropriate file to app/Model/Datasource/Database. Datasources should be named 'MyDatasource.php',
 * persistent => true / false
 * Determines whether or not the database should use a persistent connection
 * host =>
 * the host you connect to the database. To add a socket or port number, use 'port' => #
 * prefix =>
 * Uses the given prefix for all the tables in this database. This setting can be overridden
 * on a per-table basis with the Model::$tablePrefix property.
 * schema =>
 * For Postgres/Sqlserver specifies which schema you would like to use the tables in. Postgres defaults to 'public'. For Sqlserver, it defaults to empty and use
 * the connected user's default schema (typically 'dbo').
 * encoding =>
 * For MySQL, Postgres specifies the character encoding to use when connecting to the
 * database. Uses database default not specified.
 * unix_socket =>
 * For MySQL to connect via socket specify the `unix_socket` parameter instead of `host` and `port`
 */
class DATABASE_CONFIG
{
    /*
    //默认库
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' 		 => 'rm-2zed627p2g82q9v1brw.mysql.rds.aliyuncs.com',
        'port' 		 => '3306',
        'login' 	 => 'cls1allcenter',
        'password'   => 'X0hNhv36mXoSOAkHWuxhw6PVl3tphw8B',
        'database'   => 'business_center',
        'prefix'     => '',
        'encoding'   => 'utf8',
    );
    */
    //业务中心主库
    public $business_center = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'rm-2zed627p2g82q9v1brw.mysql.rds.aliyuncs.com',
        'port'       => '3306',
        'login'      => 'cls1allcenter',
        'password'   => 'X0hNhv36mXoSOAkHWuxhw6PVl3tphw8B',
        'database'   => 'business_center',
        'prefix'     => '',
        'encoding'   => 'utf8',
    );
    //财务中心主库
    public $finance_center = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'rm-2zed627p2g82q9v1brw.mysql.rds.aliyuncs.com',
        'port'       => '3306',
        'login'      => 'cls1allcenter',
        'password'   => 'X0hNhv36mXoSOAkHWuxhw6PVl3tphw8B',
        'database'   => 'finance_center',
        'prefix'     => '',
        'encoding'   => 'utf8',
    );
    //商品中心主库
    public $goods_center = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'rm-2zed627p2g82q9v1brw.mysql.rds.aliyuncs.com',
        'port'       => '3306',
        'login'      => 'cls1allcenter',
        'password'   => 'X0hNhv36mXoSOAkHWuxhw6PVl3tphw8B',
        'database'   => 'goods_center',
        'prefix'     => '',
        'encoding'   => 'utf8',
    );
    //会员中心主库
    public $member_center = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'rm-2zed627p2g82q9v1brw.mysql.rds.aliyuncs.com',
        'port'       => '3306',
        'login'      => 'cls1allcenter',
        'password'   => 'X0hNhv36mXoSOAkHWuxhw6PVl3tphw8B',
        'database'   => 'member_center',
        'prefix'     => '',
        'encoding'   => 'utf8',
    );
    //系统中心主库
    public $system_center = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'rm-2zed627p2g82q9v1brw.mysql.rds.aliyuncs.com',
        'port'       => '3306',
        'login'      => 'cls1allcenter',
        'password'   => 'X0hNhv36mXoSOAkHWuxhw6PVl3tphw8B',
        'database'   => 'system_center',
        'prefix'     => '',
        'encoding'   => 'utf8',
    );
    //统计中心主库
    public $bi_center = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'rm-2zed627p2g82q9v1brw.mysql.rds.aliyuncs.com',
        'port'       => '3306',
        'login'      => 'cls1allcenter',
        'password'   => 'X0hNhv36mXoSOAkHWuxhw6PVl3tphw8B',
        'database'   => 'bi_center',
        'prefix'     => '',
        'encoding'   => 'utf8',
    );
}


