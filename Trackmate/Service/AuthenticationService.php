<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Service;

use Trackmate\Interfaces\Authentication\IAuthentication;
use \PDO;

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
        
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        
        return $user;
    }
    
    /**
     * @inheritDoc
     */
    public function refresh($token)
    {
        // TODO: Implement refresh() method.
    }
    
}