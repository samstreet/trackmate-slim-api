<?php

/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate;

use Trackmate\Config\Config;
use Trackmate\Core\ServiceRegister;
use Trackmate\Core\Resolver;
use Trackmate\Core\Collection;
use Trackmate\Interfaces\IBootsrappable;
use Trackmate\Factory\ServiceLocatorFactory;


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
    
    public function __construct(
        Config $config,
        Resolver $resolver,
        Collection $collection
    )
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
        foreach ($this->services as $service) {
            $this->services[$service] = $this->resolver->resolve($service);
            $serviceRegister->register($service, $this->resolver->resolve($service));
        }
        
       
        
        $this->services[OAuth2\Server::class] = $server;
        $serviceRegister->register(OAuth2\Server::class, $server);
        
        $this->serviceLocator = ServiceLocatorFactory::make($serviceRegister);
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
