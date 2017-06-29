<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24/05/15
 * Time: 22:52
 */

namespace Trackmate\Service;

use \PDO;
use Trackmate\Core\Database;

class DatabaseService {
	
	protected $db;
	
	public function __construct(Database $pdo)
	{
		$this->db = $pdo;
	}
	
	public function newConnection(){
        $base = new \Service\Base();
        $config = $base->getConfig();

        $db = new PDO('mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['database'] . ';charset=utf8', $config['database']['username'], $config['database']['password']);

        return $db;
    }

    // from route /api/new-user
    public function saveNewUser($data){
        $base = new \Service\Base();
        $db = $this->db;
        $stmt = $db->prepare("INSERT INTO `user` (`firstName`, `lastName`, `username`, `password`, `email`) VALUES (?, ?, ?, ?, ?)");
        $save = $stmt->execute(array($data['firstName'], $data['lastName'], $data['userName'], $data['password'], $data['email']));
        $last_id = array("id" => $db->lastInsertId());
        // could potentially return a User Object

        $data = array("user" => array_merge($data, $last_id));
        if($save){
            $base = new \Service\Base();
            $response = $base->standardSuccessResponse(true, 200, $data);
            return $response;
        }

        return false;
    }

    // requires user and ride in order to save
    public function saveNewRide($data){
        $base = new \Service\Base();
        $db = $this->newConnection();
        $stmt = $db->prepare("INSERT INTO `ride` (`startTime`, `endTime`, `duration`, `distance`, `token`, `latLonPoints`, `viewableByPublic`, `password`, `user_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $save = $stmt->execute(array($data->getStartTime()->format("Y-m-d H:i:s"), null, $data->getDuration(), $data->getDistance(), $data->getToken(), null, $data->isViewableByPublic(), $data->getPassword(), $data->getUser()->getId()));

        $data->setId($db->lastInsertId());
        // could potentially return a User Object

        if($save) {
            $response = $base->standardSuccessResponse(true, 200, $data);
            return $response;
        }

        return false;
    }

    public function authenticate($data){
        $username = $data['username'];
        $password = $data['password'];

        $base = new \Service\Base();
        $db = $this->newConnection();
        $stmt = $db->prepare("SELECT * FROM `user` WHERE `username` = ? AND `password` = ?");
        $stmt->execute(array($username, $password));

        $result = $stmt->fetchObject();

        if($result){
            $user = new User();
            $user->setId($result->id);
            $user->setFirstName($result->firstName);
            $user->setLastName($result->lastName);
            $user->setUsername($result->username);
            $user->setEmail($result->email);
            $user->setPassword($result->password);

            //$user = $base->getUserService()->userObjectToArray($user);

            //$data = array("user" => $user, "rides" => $rideArray);
            
            $auth_token = $base->getUserService()->generateToken();
            $refresh_token = $base->getUserService()->generateToken();
            
            $store_tokens = $this->storeTokens($auth_token, $refresh_token, $user);
            
            if($store_tokens){
                return $base->standardSuccessResponse(true, 200, $store_tokens['data']);
            } 
            
        } else {
            return false;
        }

    }
    
    public function storeTokens($auth_token, $refresh_token, $user){
        $base = new \Service\Base();
        $db = $this->newConnection();
        
        $user_id = $user->getId();
        
        $expire_auth_date = (new \DateTime())->add(new DateInterval("PT6H"));
        $expire_refresh_date = (new \DateTime())->add(new DateInterval("PT12H"));
        
        $stmt = $db->prepare("INSERT INTO `auth_token`(`token`, `expires`, `user_id`) VALUES (?, ?, ?)");
        $stmt->execute(array($auth_token, $expire_auth_date->format("Y-m-d H:i:s"), $user_id));
        
        $stmt = $db->prepare("INSERT INTO `refresh_token`(`token`, `expires`, `user_id`) VALUES (?, ?, ?)");
        $stmt->execute(array($auth_token, $expire_refresh_date->format("Y-m-d H:i:s"), $user_id));
        
        $data = array(
            "auth" => array(
                "token" => $auth_token,
                "auth_expires" => $expire_auth_date
            ),
            "refresh" => array(
                "token" => $refresh_token,
                "refresh_expires" => $expire_refresh_date
            )
        );
        
        if($stmt){
            return $base->standardSuccessResponse(true, "success", $data);
        }
        
        return false;
    }

    public function getRideByToken($token){
        $base = new \Service\Base();
        $db = $this->newConnection();
        $stmt = $db->prepare("SELECT * FROM `ride` WHERE `token` = ?");
        $token = $stmt->execute(array($token));

        $result = $stmt->fetchObject();

        if($result){
            $data = array(
                'id' => $result->id,
                'startTime' => $result->startTime,
                'endTime' => $result->endTime,
                'distance' => $result->distance,
                'duration' => $result->duration,
                'token' => $result->token,
                'latLonPoints' => array(),
                'password' => $result->password
            );

            return $data;
        }

        return false;

    }

    public function saveRide(Ride $ride, User $user){
        // merge the two together and extract the relevant data
        return true;
    }

    // delete a ride by an id
    // could potentially expand this to remove by user_id etc.
    public function deleteRideById($id, $user_id){
        $base = new \Service\Base();
        $db = $this->newConnection();
        $stmt = $db->prepare("DELETE FROM `ride` WHERE `id` = ? AND `user_id` = ?");
        $result = $stmt->execute(array($id, $user_id));

        if($result){
            return true;
        }

        return false;

    }

    // can't see why I may ever need this
    public function deleteRideByToken($token){}

    public function deleteAllRidesByUserId($user_id){
        return true;
    }


    // pass in a username and an email address
    // check the db
    // return true if one exists
    // false is it doesn't
    public function doesUserAlreadyExist($username, $email){

        $base = new \Service\Base();
        $db = $this->newConnection();

        $stmt = $db->prepare("SELECT * FROM `user` WHERE `username` = ? OR `email` = ?");
        $execute = $stmt->execute(array($username, $email));

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return true;
        }

        return false;
    }


}