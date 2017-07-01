<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Controller;

use Slim\Container;
use Trackmate\Interfaces\IServiceLocatorAware;

class BaseController implements IServiceLocatorAware
{
	protected $app;
	
	public function __construct(Container $app)
	{
		$this->app = $app;
	}
	
	public function get($identifier)
	{
		return $this->app->get("sl")->get($identifier);
	}
	
	public function register($identifier, $service, $params = [])
	{
		throw new \Exception("Method Not Used");
	}
	
	public function has($identifier)
	{
		return $this->app->get("sl")->has($identifier);
	}
	
	
}