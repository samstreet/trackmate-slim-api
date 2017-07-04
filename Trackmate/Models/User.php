<?php

namespace Trackmate\Models;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 24/05/15
 * Time: 22:39
 */

class User
{
    protected $_id;
    protected $_firstName;
    protected $_lastName;
    protected $_rides = array(); // array of ride models
    protected $_username;
    protected $_password;
    protected $_email;
    protected $_access_token;
    protected $_refresh_token;
    
    
    // public getters and setters
    
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
    public function getFirstName()
    {
        return $this->_firstName;
    }
    
    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }
    
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }
    
    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }
    
    /**
     * @return array
     */
    public function getRides()
    {
        return $this->_rides;
    }
    
    /**
     * @param array $rides
     */
    public function setRides($rides)
    {
        $this->_rides = $rides;
    }
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }
    
    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
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
    public function getEmail()
    {
        return $this->_email;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }
    
    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->_access_token;
    }
    
    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->_access_token = $access_token;
    }
    
    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->_refresh_token;
    }
    
    /**
     * @param mixed $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->_refresh_token = $refresh_token;
    }
    
    
}