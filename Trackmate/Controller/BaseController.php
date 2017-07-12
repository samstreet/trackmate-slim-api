<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Controller;

use Slim\Container;
use Trackmate\Interfaces\IServiceLocatorAware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class BaseController implements IServiceLocatorAware
{
    protected $app;
    
    protected $server;
    
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
    
    public function getUserService()
    {
        return $this->get("user");
    }
    
    public function getAuthService()
    {
        return $this->get("auth");
    }
    
    public function app()
    {
        return $this->app;
    }
    
}