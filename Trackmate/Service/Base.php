<?php

namespace Trackmate\Service;

use Trackmate\Config\Config;
use Trackmate\Core\Database;

class Base
{
    
    protected $db;
    
    public function __construct(Database $conn)
    {
        $this->db = $conn;
    }
    
    // base class
    protected $_databaseService = null;
    protected $_RideService = null;
    protected $_userService = null;
    protected $_config = null;
    
    // could cache
    public function getConfig()
    {
        $this->_config = Config::getConfig();
        return $this->_config;
    }
    
    public function getDatabaseService()
    {
        if ($this->_databaseService == null) {
            $this->_databaseService = new DatabaseService($this->db);
        }
        
        return $this->_databaseService;
    }
    
    public function getRideService()
    {
        if ($this->_RideService == null) {
            $this->_RideService = new RideService();
        }
        
        return $this->_RideService;
    }
    
    public function getUserService()
    {
        if ($this->_userService == null) {
            $this->_userService = new UserService();
        }
        
        return $this->_userService;
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