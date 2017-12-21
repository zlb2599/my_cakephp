<?php
/**
 * Application model for Cake.
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 * PHP 5
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 * @package       app.Model
 */
class AppModel extends Model
{
    /**
     * Security code of Database field.
     * @var string
     */
    private static $code = 'I8feVXtTO0mv42QB9omOjvV9JyunNrZb';

    /**
     * Encrypt table field.
     * Usage:
     * ```php
     * $array = [
     *     FieldToolkit::encrypt('name'),
     *     FieldToolkit::encrypt('name', 'alias'),
     *     FieldToolkit::encrypt('name', 'alias', 'prefix'),
     * ];
     * [
     *     "ENCODE(name, 'your secret')",
     *     "ENCODE(name, 'your secret') AS alias",
     *     "ENCODE(prefix.name, 'your secret') AS alias",
     * ]
     * ```
     * @param string $field 字段
     * @param string $alias 别名
     * @param string $prefix 前缀
     * @return string
     */
    public static function encrypt($field, $alias = '', $prefix = '')
    {
        $key    = self::$code;
        $prefix = $prefix?"{$prefix}.":'';
        $value  = "ENCODE('{$prefix}{$field}', '{$key}')";

        if ($alias) {
            return $value.' AS '.$alias;
        }

        return $value;
    }

    /**
     * 解密数据字段
     * Usage:
     * ```php
     * $array = [
     *     FieldToolkit::decrypt('name'),
     *     FieldToolkit::decrypt('name', 'alias'),
     *     FieldToolkit::decrypt('name', 'alias', 'prefix'),
     * ];
     * [
     *     "DECODE(name, 'your secret')",
     *     "DECODE(name, 'your secret') AS alias",
     *     "DECODE(prefix.name, 'your secret') AS alias",
     * ]
     * ```
     * @param string $field 字段
     * @param string $alias 别名
     * @param string $prefix 前缀
     * @return string
     */
    public static function decrypt($field, $alias = '', $prefix = '')
    {
        $key    = self::$code;
        $prefix = $prefix?"{$prefix}.":'';
        $value  = "DECODE({$prefix}{$field}, '{$key}')";

        if ($alias) {
            return $value.' AS '.$alias;
        }

        return $value;
    }
}
