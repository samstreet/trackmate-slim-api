<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Service;

use Trackmate\Interfaces\Authentication\IAuthentication;

/**
 * Class AuthenticationService
 * @package Trackmate\Service
 *
 * Used to hndle authentication of users
 */
class AuthenticationService extends Base implements IAuthentication
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