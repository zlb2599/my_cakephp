<?php
/**
 * Basic authentication
 * PHP 5
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Network.Http
 * @since         CakePHP(tm) v 2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Basic authentication
 * @package       Cake.Network.Http
 */
class BasicAuthentication
{

    /**
     * Authentication
     * @param HttpSocket $http
     * @param array      $authInfo
     * @return void
     * @see http://www.ietf.org/rfc/rfc2617.txt
     */
    public static function authentication(HttpSocket $http, &$authInfo)
    {
        if (isset($authInfo['user'], $authInfo['pass'])) {
            $http->request['header']['Authorization'] = self::_generateHeader($authInfo['user'], $authInfo['pass']);
        }
    }

    /**
     * Generate basic [proxy] authentication header
     * @param string $user
     * @param string $pass
     * @return string
     */
    protected static function _generateHeader($user, $pass)
    {
        return 'Basic '.base64_encode($user.':'.$pass);
    }

    /**
     * Proxy Authentication
     * @param HttpSocket $http
     * @param array      $proxyInfo
     * @return void
     * @see http://www.ietf.org/rfc/rfc2617.txt
     */
    public static function proxyAuthentication(HttpSocket $http, &$proxyInfo)
    {
        if (isset($proxyInfo['user'], $proxyInfo['pass'])) {
            $http->request['header']['Proxy-Authorization'] = self::_generateHeader($proxyInfo['user'], $proxyInfo['pass']);
        }
    }

}
