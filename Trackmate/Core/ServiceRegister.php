<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;

use Trackmate\Interfaces\IServiceLocatorAware;

class ServiceRegister implements IServiceLocatorAware
{
	/**
	 * The register of services
	 * @var
	 */
	protected $register = [];
	
	public function __construct()
	{
	}
	
	/**
	 * Register a new service with the collection
	 * @param $identifier
	 * @param $service
	 * @return Collection
	 */
	public function register($identifier, $service, $params= []){
		$this->register[$identifier] = [
			"class" => $service,
			"deps" => $params
		];
		
		return $this->register;
	}
	
	/**
	 * Get a servcice
	 * @param $identifier
	 * @return mixed
	 */
	public function get($identifier)
	{
		$class = $this->register[$identifier];
		$object = $class["class"];
		$deps = $class["deps"];
		
		if( !is_null($deps) ){
			switch(count($deps)){
				case 1:
					return new $object($deps[0]);
					break;
				case 2:
					return new $object($deps[0], $deps[1]);
					break;
				case 2:
					return new $object($deps[0], $deps[1], $deps[2]);
					break;
				default:
					return new $object();
			}
		}
	}
	
	/**
	 * Do we have a service
	 * @param $identifier
	 * @return mixed
	 */
	public function has($identifier)
	{
		return isset($this->register[$identifier]);
	}
	
	
}
