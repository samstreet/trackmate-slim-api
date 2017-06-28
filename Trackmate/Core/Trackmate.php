<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;

use Trackmate\Config\Config;
use Trackmate\Core\ServiceRegister;
use Trackmate\Core\ServiceLocator;

/**
 * Class Trackmate
 * The default Trackmate instance
 * @package Trackmate\Core
 */
class Trackmate
{
	protected $config;
	
	protected $services;
	
	protected $routes;
	
	protected $serviceLocator;
	
	public function __construct(Config $config)
	{
		$this->config = $config;
	}
	
	/**
	 * Bootstrap the Trackmate application
	 */
	public function bootstrap()
	{
		$this->config = $this->config->bootstrap();
		$this->services = $this->config->services;
		$this->routes = $this->config->routes;
		
		$this->initServiceLocator();
		
		return $this;
	}
	
	private function initServiceLocator(){
		$serviceRegister = new ServiceRegister();
		$serviceRegister->register("base","Trackmate\Service\Base", [new \PDO('mysql:host=127.0.0.1;dbname=trackmate;charset=utf8', 'trackmate', 'trackmate')]);
		$serviceRegister->register("db", "Trackmate\Service\DatabaseService", [new \PDO('mysql:host=127.0.0.1;dbname=trackmate;charset=utf8', 'trackmate', 'trackmate')]);
		$serviceRegister->register("user", "Trackmate\Service\UserService");
		$serviceRegister->register("ride", "Trackmate\Service\RideService");
		
		$serviceLocator = new ServiceLocator($serviceRegister);
		
		$this->serviceLocator = $serviceLocator;
	}
	
	/**
	 * @return mixed
	 */
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}
	
	
}
