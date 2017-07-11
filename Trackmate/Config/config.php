<?php

/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Config;

use Trackmate\Interfaces\IBootsrappable;
use Trackmate\Service\Base;
use Trackmate\Service\DatabaseService;
use Trackmate\Service\HalService;
use Trackmate\Service\AuthenticationService;
use Trackmate\Service\User\UserAuthenticationService;
use Trackmate\Service\UserService;

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
        if (__ENVIRONMENT__ == 'dev') {
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
            Base::class,
            DatabaseService::class,
            UserService::class,
            AuthenticationService::class,
            UserAuthenticationService::class,
            HalService::class
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
    
    private function routeBuilder()
    {
    
    }
    
    private function serviceBuilder()
    {
    
    }
    
    private function controllerBuilder()
    {
        return [
            "BaseController" => "Trackmate\Controller\BaseController",
            "AuthController" => "Trackmate\Controller\AuthController",
            "UserController" => "Trackmate\Controller\UserController"
        ];
    }
    
    
}
