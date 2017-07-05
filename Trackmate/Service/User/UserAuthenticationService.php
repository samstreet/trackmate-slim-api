<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Service\User;


use Trackmate\Service\Base;
use Trackmate\Interfaces\Authentication\IAuthentication;

/**
 * Class UserAuthenticationService
 * @package Trackmate\Service\User
 */
class UserAuthenticationService extends Base implements IAuthentication
{
    /**
     * @inheritDoc
     */
    public function authenticate($username, $password)
    {
        // TODO: Implement authenticate() method.
    }
    
    /**
     * @inheritDoc
     */
    public function refresh($token)
    {
        // TODO: Implement refresh() method.
    }
    
}