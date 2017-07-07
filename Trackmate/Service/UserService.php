<?php

/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Service;

use Trackmate\Models\User;

class UserService
{
    /**
     * Convert an array to a user object
     *
     * @param array $user data to make a user
     *
     * @return User
     */
    public function userArrayToUserObject($user)
    {
        $convUser = new User();
        $convUser->setId($user['id']);
        $convUser->setFirstName($user['firstName']);
        $convUser->setLastName($user['lastName']);
        $convUser->setUserName($user['userName']);
        $convUser->setPassword($user['password']);
        $convUser->setEmail($user['email']);
        
        return $convUser;
    }
    
    /**
     * Convert a user object to an array
     *
     * @param User $user the user object to convert
     *
     * @return array
     */
    public function userObjectToArray(User $user)
    {
        return array(
            'id' => $user->getId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'userName' => $user->getUsername(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail()
        );
    }
    
    // will generate an auth and refresh token
    public function generateToken()
    {
        return $token = bin2hex(openssl_random_pseudo_bytes(32));
    }
    
}
