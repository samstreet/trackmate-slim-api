<?php

/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Service;

use Trackmate\Config\Config;
use Trackmate\Core\Database;
use Trackmate\Core\Resolver;
use Trackmate\Exceptions\MethodNotAllowedException;
use Trackmate\Interfaces\IServiceLocatorAware;

/**
 * Class Base
 * @package Trackmate\Service
 */
class Base implements IServiceLocatorAware
{
    
    protected $db;
    
    protected $resolver;
    
    protected $_config = null;
    
    public function __construct(Database $conn, Resolver $resolver)
    {
        $this->db = $conn;
        $this->resolver = $resolver;
    }
    
    // could cache
    public function getConfig()
    {
        $this->_config = Config::getConfig();
        return $this->_config;
    }
    
    public function getDatabaseService()
    {
        return  $this->resolver->resolve(Database::class);
    }
    
    public function getRideService()
    {
        return $this->resolver->resolve(RideService::class);
    }
    
    public function getUserService()
    {
        return $this->resolver->resolve(UserService::class);
    }
    
    /**
     * @inheritDoc
     */
    public function get($identifier)
    {
        return $this->resolver->resolve($identifier);
    }
    
    /**
     * @inheritDoc
     */
    public function register($identifier, $service, $params = [])
    {
        throw new MethodNotAllowedException();
    }
    
    /**
     * @inheritDoc
     */
    public function has($identifier)
    {
        $class = $this->resolver->resolve($identifier);
        return null != $class;
    }
    
    
    public function standardErrorResponse($error, $status, $success = false)
    {
        return array(
            "error" => $error,
            "status" => $status,
            "success" => $success
        );
    }
    
    public function standardSuccessResponse($success, $status, $options = null)
    {
        if (!is_null($options)) {
            return array(
                "success" => $success,
                "status" => $status,
                "data" => $options
            );
        } else {
            return array(
                "success" => $success,
                "status" => $status
            );
        }
    }
    
    // wip
    public function doesKeyExist($key, $data, $app)
    {
        if (!array_key_exists($key, $data)) {
            $app->contentType("application/json");
            $app->status($app->response()->getStatus());
            $string = json_encode($this->standardErrorResponse("Param 'user' is required and cannot be null", $app->response()->getStatus()));
            return $app->response()->setBody($string);
        }
    }
    
    // some cache stuff
}