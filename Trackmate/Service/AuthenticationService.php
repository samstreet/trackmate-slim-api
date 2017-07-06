<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Service;

use Trackmate\Core\Database;
use Trackmate\Core\Resolver;
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
        return [
            "user" => [
                "id" => "1",
                "name" => "Sam Street"
            ]
        ];
    }
    
    /**
     * @inheritDoc
     */
    public function refresh($token)
    {
        // TODO: Implement refresh() method.
    }
    
}