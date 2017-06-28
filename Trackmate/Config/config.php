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

    protected $config;

    /**
     * @return mixed
     */
    public function bootstrap()
    {
        if(__ENVIRONMENT__ == 'dev') {
            $config = array(
                'database' => array(
                    'host' => '127.0.0.1',
                    'database' => 'trackmate',
                    'username' => 'trackmate',
                    'password' => 'trackmate'
                ),
                'otherOptions' => array()
            );
        } else {
            $config = array(
                'database' => array(
                    'host' => '217.199.187.63',
                    'database' => 'cl51-samstreet',
                    'username' => 'cl51-samstreet',
                    'password' => '7UU/kdR9h'
                ),
                'otherOptions' => array()
            );
        }
        
        $config["routes"] = [];
        
        $config["services"] = array(
        	"base" => [
        		"class" => "Trackmate\Service\Base",
				"deps" => [
					new \PDO('mysql:host=127.0.0.1;dbname=trackmate;charset=utf8', 'trackmate','trackmate')
				]
			],
			"db" => [
				"class" => "Trackmate\Service\DatabaseService",
				"deps" => [
					new \PDO('mysql:host=127.0.0.1;dbname=trackmate;charset=utf8', 'trackmate','trackmate')
				]
			],
			"user" => [
				"class" => "Trackmate\Service\UserService",
				"deps" => [
				
				]
			],
			"ride" => [
				"class" => "Trackmate\Service\RideService",
				"deps" => [
				
				]
			]
		);
        
        $this->config = $config;
        
        return $this;
    }
}
