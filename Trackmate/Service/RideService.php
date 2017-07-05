<?php

/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Service;

use Trackmate\Models\Ride;


class RideService
{
    
    public static function returnRide()
    {
    
    }
    
    public function getRideById($id)
    {
    
    }
    
    public function newRide(User $user)
    {
        $ride = new Ride();
        $startTime = new \DateTime();
        $token = $this->generateToken();
        
        $ride->setStartTime($startTime);
        $ride->setToken($token);
        $ride->setViewableByPublic(true);
        $ride->setDistance(0);
        $ride->setDuration(0);
        $ride->setUser($user);
        
        return $ride;
    }
    
    public function rideObjectToArray(Ride $ride, $userArray)
    {
        return array(
            "ride" => array(
                'id' => $ride->getId(),
                'startTime' => $ride->getStartTime(),
                'endTime' => $ride->getEndTime(),
                'duration' => $ride->getDuration(),
                'distance' => $ride->getDistance(),
                'latLonPoint' => $ride->getLatAndLonPoints(),
                'viewableByPublic' => $ride->isViewableByPublic(),
                'token' => $ride->getToken(),
            
            ),
            'user' => $userArray
        );
    }
    
    public function generateToken()
    {
        return $token = bin2hex(openssl_random_pseudo_bytes(3));
    }
}