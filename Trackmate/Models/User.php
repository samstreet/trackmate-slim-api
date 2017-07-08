<?php

namespace Trackmate\Models;

/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

class User
{
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $rides = array(); // array of ride models
    protected $username;
    protected $password;
    protected $email;
    protected $access_token;
    protected $refresh_token;
    
    
    // public getters and setters
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    /**
     * @return array
     */
    public function getRides()
    {
        return $this->rides;
    }
    
    /**
     * @param array $rides
     */
    public function setRides($rides)
    {
        $this->rides = $rides;
    }
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
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
        return $this->password;
    }
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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
        return $this->access_token;
    }
    
    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }
    
    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }
    
    /**
     * @param mixed $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }
    
    
}