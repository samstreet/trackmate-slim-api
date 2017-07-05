<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Interfaces\Authentication;

/**
 * Interface IAuthentication
 * @package Trackmate\Interfaces\Authentication
 */
interface IAuthentication
{
    /**
     * Used to authenticate a user against a username and password
     * @param $username
     * @param $password
     * @return mixed
     */
    public function authenticate($username, $password);
    
    /**
     * Handle refresh tokens to see if a user is valid
     * @param $token
     * @return mixed
     */
    public function refresh($token);
    
    
}