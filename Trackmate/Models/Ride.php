<?php

namespace Trackmate\Models;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 24/05/15
 * Time: 22:43
 */

class Ride
{
    protected $_id;
    protected $_startTime;
    protected $_endTime;
    protected $_duration;
    protected $_distance;
    protected $_token;
    protected $_latAndLonPoints = array();
    protected $_viewableByPublic = true; // if yes then anyone can see, if false then you need to be authenticated to see
    protected $_password;
    protected $_user;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->_startTime;
    }
    
    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->_startTime = $startTime;
    }
    
    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->_endTime;
    }
    
    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->_endTime = $endTime;
    }
    
    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->_duration;
    }
    
    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->_duration = $duration;
    }
    
    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->_distance;
    }
    
    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->_distance = $distance;
    }
    
    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->_token;
    }
    
    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->_token = $token;
    }
    
    /**
     * @return array
     */
    public function getLatAndLonPoints()
    {
        return $this->_latAndLonPoints;
    }
    
    /**
     * @param array $latAndLonPoints
     */
    public function setLatAndLonPoints($latAndLonPoints)
    {
        $this->_latAndLonPoints = $latAndLonPoints;
    }
    
    /**
     * @return boolean
     */
    public function isViewableByPublic()
    {
        return $this->_viewableByPublic;
    }
    
    /**
     * @param boolean $viewableByPublic
     */
    public function setViewableByPublic($viewableByPublic)
    {
        $this->_viewableByPublic = $viewableByPublic;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }
    
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->_user;
    }
    
    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    } // user object
    
    
}