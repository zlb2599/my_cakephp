<?php

/**
 * This is redis configuration file.
 */
class RedisConfig
{

    public function getConfig()
    {
        return array(
            'prefix'     => null,
            'server'     => '127.0.0.1',
            'port'       => '6379',
            'password'   => false,
            'timeout'    => 30,
            'persistent' => true,
        );
    }
}
