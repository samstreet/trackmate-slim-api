<?php

namespace Trackmate\Service;

use Trackmate\Models\User;

class UserService {

    public function userArrayToUserObject($user){
        $convUser = new User();
        $convUser->setId($user['id']);
        $convUser->setFirstName($user['firstName']);
        $convUser->setLastName($user['lastName']);
        $convUser->setUserName($user['userName']);
        $convUser->setPassword($user['password']);
        $convUser->setEmail($user['email']);

        return $convUser;
    }

    public function userObjectToArray(User $user){
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
    public function generateToken(){
        return $token = bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function isAuthTokenValid(){ return true; }
    
    public function isRefreshTokenValid(){ return true; }
}