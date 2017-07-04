<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate;

use Trackmate\Config\Config;
use Trackmate\Core\ServiceRegister;
use Trackmate\Core\ServiceLocator;
use Trackmate\Core\Resolver;
use Trackmate\Core\Collection;
use Trackmate\Interfaces\IBootsrappable;

/**
 * Class Trackmate
 * The default Trackmate instance
 * @package Trackmate\Core
 */
class Trackmate implements IBootsrappable
{
    protected $config;
    
    protected $services;
    
    protected $routes;
    
    protected $serviceLocator;
    
    protected $resolver;
    
    protected $controllers;
    
    public function __construct(Config $config, Resolver $resolver, Collection $collection)
    {
        $this->config = $config;
        $this->resolver = $resolver;
        $this->controllers = $collection;
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
        $this->initControllers();
        
        return $this;
    }
    
    private function initServiceLocator()
    {
        $serviceRegister = new ServiceRegister();
        foreach ($this->services as $key => $service) {
            $this->services[$key] = $this->resolver->resolve($service["class"]);
            $serviceRegister->register($key, $this->resolver->resolve($service["class"]));
        }
        
        $serviceLocator = new ServiceLocator($serviceRegister);
        
        $this->serviceLocator = $serviceLocator;
    }
    
    public function initControllers()
    {
        $controllers = $this->config->getControllers();
        
        foreach ($controllers as $alias => $controller) {
            $this->controllers->add($alias, $this->resolver->resolve($controller));
        }
    }
    
    /**
     * @return mixed
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
    
    /**
     * @return mixed
     */
    public function getControllers()
    {
        return $this->controllers;
    }
    
    
}
