<?php

namespace Trackmate\Config;

use Trackmate\Interfaces\IBootsrappable;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 26/05/15
 * Time: 08:05
 */
Class Config implements IBootsrappable
{

    protected $config;
    
    protected $services;
    
    protected $routes;
    
    protected $controllers;

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
		$config["controllers"] = $this->controllerBuilder();
        
        $config["services"] = array(
        	"base" => [
        		"class" => "Trackmate\Service\Base"
			],
			"db" => [
				"class" => "Trackmate\Service\DatabaseService"
			],
			"user" => [
				"class" => "Trackmate\Service\UserService"
			],
			"ride" => [
				"class" => "Trackmate\Service\RideService"
			]
		);
        
        $this->config = $config;
        $this->services = $config["services"];
        $this->controllers = $config["controllers"];
        $this->routes = $config["routes"];
        
        return $this;
    }
	
	/**
	 * @return mixed
	 */
	public function getConfig()
	{
		return $this->config;
	}
	
	/**
	 * @return mixed
	 */
	public function getServices()
	{
		return $this->services;
	}
	
	/**
	 * @return mixed
	 */
	public function getRoutes()
	{
		return $this->routes;
	}
	
	/**
	 * @return mixed
	 */
	public function getControllers()
	{
		return $this->controllers;
	}
	
	private function routeBuilder(){
	
	}
	
	private function serviceBuilder(){
	
	}
	
	private function controllerBuilder(){
		return [
			"BaseController" => "Trackmate\Controller\UserController",
			"UserController" => "Trackmate\Controller\UserController",
			"RideController" => "Trackmate\Controller\RideController"
		];
	}
	
	
 
 
}
