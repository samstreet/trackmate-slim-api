<?php

namespace Trackmate\Config;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 26/05/15
 * Time: 08:05
 */
Class Config
{

    protected $_config;

    /**
     * @return mixed
     */
    public static function getConfig()
    {
        if(__ENVIRONMENT__ == 'dev') {
            $config = array(
                'database' => array(
                    'host' => '127.0.0.1',
                    'database' => 'trackmate',
                    'username' => 'trackmate',
                    'password' => 'trackmate'
                ),
                'otherOptions' => array(),
				"services" => array()
            );
        } else {
            $config = array(
                'database' => array(
                    'host' => '217.199.187.63',
                    'database' => 'cl51-samstreet',
                    'username' => 'cl51-samstreet',
                    'password' => '7UU/kdR9h'
                ),
                'otherOptions' => array(),
				"services" => array()
            );
        }
        
        $config["services"] = array(
        	"base" => "Trackmate\Service\Base",
			"db" => "Trackmate\Service\DatabaseService",
			"user" => "Trackmate\Service\UserService",
			"ride" => "Trackmate\Service\RideService"
		);
        
        return $config;
    }




}