<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;

use Trackmate\Config\Config;
use Trackmate\Core\ServiceRegister;
use Trackmate\Core\ServiceLocator;
use Trackmate\Core\Resolver;

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
	
	protected $resolver;
	
	public function __construct(Config $config, Resolver $resolver)
	{
		$this->config = $config;
		$this->resolver = $resolver;
	}
	
	/**
	 * Bootstrap the Trackmate application
	 */
	public function bootstrap()
	{
		$this->config = $this->config->bootstrap();
		$this->services = $this->config->getConfig()["services"];
		$this->routes = $this->config->getConfig()["routes"];
		
		$this->initServiceLocator();
		
		return $this;
	}
	
	private function initServiceLocator()
	{
		$serviceRegister = new ServiceRegister();
		foreach($this->services as $key => $service){
			$this->services[$key] = $this->resolver->resolve($service["class"]);
			$serviceRegister->register($key, $this->resolver->resolve($service["class"]));
		}
		
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
