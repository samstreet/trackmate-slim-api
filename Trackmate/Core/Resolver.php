<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;

use \ReflectionClass;
use \ReflectionParameter;
use \Exception;

class Resolver
{
	public function resolve($class)
	{
		$reflector = new ReflectionClass($class);
		
		if( ! $reflector->isInstantiable())
		{
			throw new \Exception("[$class] is not instantiable");
		}
		
		$constructor = $reflector->getConstructor();
		
		if(is_null($constructor))
		{
			return new $class;
		}
		
		$parameters = $constructor->getParameters();
		$dependencies = $this->getDependencies($parameters);
		
		return $reflector->newInstanceArgs($dependencies);
	}
	
	public function getDependencies($parameters)
	{
		$dependencies = array();
		
		foreach($parameters as $parameter)
		{
			$dependency = $parameter->getClass();
			
			if(is_null($dependency))
			{
				$dependencies[] = $this->resolveNonClass($parameter);
			}
			else
			{
				$dependencies[] = $this->resolve($dependency->name);
			}
		}
		
		return $dependencies;
	}
	
	public function resolveNonClass(ReflectionParameter $parameter)
	{
		if($parameter->isDefaultValueAvailable())
		{
			return $parameter->getDefaultValue();
		}
		
		throw new Exception("Erm.. Cannot resolve the unkown!?");
	}
}