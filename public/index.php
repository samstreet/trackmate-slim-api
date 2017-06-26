<?php

use Trackmate\Service\Base as BaseService;
use Slim\Slim;

require '../vendor/autoload.php';

define('__ROOT__', '/');
if($_SERVER['HTTP_HOST'] == "dev.trackmate.com") {
    define('__ENVIRONMENT__', 'dev');
} else {
    define('__ENVIRONMENT__', 'live');
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
	'templates.path' => '..' . __ROOT__ . 'templates/'
));

// register the services
$app->__set("config", new Trackmate\Config\Config());
$app->__set("baseService", new Trackmate\Service\Base(
	new \PDO(
		"mysql:host=".$app->__get("config")->getConfig()["database"]["host"].';dbname='.$app->__get("config")->getConfig()["database"]["database"].';charset=utf8',
		$app->__get("config")->getConfig()["database"]["username"],
		$app->__get("config")->getConfig()["database"]["password"]
	)
));
$app->__set("dbService", new Trackmate\Service\DatabaseService(
	new \PDO(
		"mysql:host=".$app->__get("config")->getConfig()["database"]["host"].';dbname='.$app->__get("config")->getConfig()["database"]["database"].';charset=utf8',
		$app->__get("config")->getConfig()["database"]["username"],
		$app->__get("config")->getConfig()["database"]["password"]
	)
));
$app->__set("userService", new Trackmate\Service\UserService());
$app->__set("rideService", new Trackmate\Service\RideService());

// post routes
$app->post(
	'/api/new-ride',
	function () use ($app){
		$app->request()->headers->set("Accept", "application/json");
		$base = new BaseService();
		$postData = json_decode($app->request()->getBody(), true);
		if(!array_key_exists('user', $postData)){
			$app->response()->header("Content-Type", "application/json");
			$app->status($app->response()->getStatus());
			$string = json_encode($base->standardErrorResponse("Param 'user' is required and cannot be null", $app->response()->getStatus()));
			return $app->response()->setBody($string);
		}
		
		// get the required user posted data anc conv to object
		$user = $base->getUserService()->userArrayToUserObject($postData['user']);
		
		// make a new ride with the user details attached
		$ride = $base->getRideService()->newRide($user);
		
		// save the ride
		$save = $base->getDatabaseService()->saveNewRide($ride);
		
		// convert it all back to an array so we can encode it
		$user = $base->getUserService()->userObjectToArray($user);
		$ride = $base->getRideService()->rideObjectToArray($ride, $user);
		
		// if save is successful encode the data and return else return an error response
		if($save){
			$app->response()->header("Content-Type", "application/json");
			$app->status($app->response()->getStatus());
			$string = json_encode($base->standardSuccessResponse(true, $app->response()->getStatus(), $ride));
			return $app->response()->setBody($string);
			
		} else {
			$app->response()->header("Content-Type", "application/json");
			$app->status(500);
			echo json_encode($base->standardErrorResponse("Save failed", 500));
		}
	}
);

$app->post(
	'/api/save-ride',
	function () use ($app){
		$app->request()->headers->set("Accept", "application/json");
		$base = new BaseService();
		$postData = json_decode($app->request()->getBody(), true);
		
		$save = $base->getDatabaseService()->saveRide($postData);
		
		if($save){
			$app->response()->header("Content-Type", "application/json");
			$app->status(200);
			$string = json_encode($base->standardSuccessResponse("true", 200, $save['data']));// return a response object.
			return $app->response()->setBody($string);
		} else {
			$app->response()->header("Content-Type", "application/json");
			$app->status(500);
			$string =  json_encode($base->standardErrorResponse("Save failed", 500));
			return $app->response()->setBody($string);
		}
		
		return true;
	}
);

$app->post(
	'/api/new-user',
	function () use ($app){
		$app->request()->headers->set("Accept", "application/json");
		$base = new BaseService();
		$postData = json_decode($app->request()->getBody(), true);
		// error handling if param is missing
		if(!array_key_exists('user', $postData)){
			$app->response()->header("Content-Type", "application/json");
			$app->status($app->response()->getStatus());
			$string = json_encode($base->standardErrorResponse("Param 'user' is required and cannot be null", $app->response()->getStatus()));
			return $app->response()->setBody($string);
		}
		
		$checkUsername = $base->getDatabaseService()->doesUserAlreadyExist($postData['user']['userName'], $postData['user']['email']);
		
		// will return an error response if there is already a user
		if($checkUsername){
			$app->response()->header("Content-Type", "application/json");
			$app->status($app->response()->getStatus());
			$string = json_encode($base->standardErrorResponse("Username or Email is already registered", $app->response()->getStatus()));
			return $app->response()->setBody($string);
		}
		
		// everything okay, save a user
		
		$save = $base->getDatabaseService()->saveNewUser($postData['user']);
		
		if($save){
			$app->response()->header("Content-Type", "application/json");
			$app->status(200);
			$string = json_encode($base->standardSuccessResponse("true", 200, $save['data']));// return a response object.
			return $app->response()->setBody($string);
		} else {
			$app->response()->header("Content-Type", "application/json");
			$app->status(500);
			$string =  json_encode($base->standardErrorResponse("Save failed", 500));
			return $app->response()->setBody($string);
		}
	}
);

// authenticate a user
$app->post('/api/authenticate', function() use ($app){
	$app->request()->headers->set("Accept", "application/json");
	$base = new BaseService();
	$postData = json_decode($app->request()->getBody(), true);
	
	$login = $base->getDatabaseService()->authenticate($postData);
	if($login){
		$app->response()->header("Content-Type", "application/json");
		$app->status(200);
		//$data = array("user" => $login['data']);
		$string = json_encode($base->standardSuccessResponse("true", 200, $login['data']));// return a response object.
		return $app->response()->setBody($string);
	}
	
	$app->response()->header("Content-Type", "application/json");
	$app->status(401);
	$string =  json_encode($base->standardErrorResponse("Authentication failed", 500));
	return $app->response()->setBody($string);
});

// get routes
$app->get('/', function () use ($app) {
	die(var_dump($app->__get("userService")->generateToken()));
	$app->render("index.php");
}
);

$app->get('/api/ride/:token', function ($token) use ($app) {
	$app->request()->headers->set("Accept", "application/json");
	$base = new BaseService();
	
	$db = $base->getDatabaseService();
	$ride = $db->getRideByToken($token);
	if($ride && $ride['password'] == null) {
		$app->response()->header("Content-Type", "application/json");
		$app->status(200);
		$string = json_encode($base->standardSuccessResponse("true", 200, array("ride" => $ride)));// return a response object.
		return $app->response()->setBody($string);
	}
	elseif($ride && $ride['password'] != null){
		$app->response()->header("Content-Type", "application/json");
		$app->status(401);
		$string =  json_encode($base->standardErrorResponse("Password required to view this ride", $app->response()->getStatus()));
		return $app->response()->setBody($string);
	}
	else {
		$app->response()->header("Content-Type", "application/json");
		$app->status(404);
		$string =  json_encode($base->standardErrorResponse("No ride found with that token", $app->response()->getStatus()));
		return $app->response()->setBody($string);
	}
});

// put routes

// delete routes

// send a JSON Ride Object
$app->delete(
	'/api/delete-ride/:id',
	function ($id) use ($app) {
		$postData = json_decode($app->request()->getBody(), true);
		$app->request()->headers->set("Accept", "application/json");
		$base = new BaseService();
		
		$db = $base->getDatabaseService();
		
		if ($postData["ride"]["user_id"] == $postData["user"]["id"]) {
			$ride = $db->deleteRideById($postData["ride"]["id"], $postData["user"]["id"]);
		} else {
			$app->response()->header("Content-Type", "application/json");
			$app->status(401);
			$string =  json_encode($base->standardErrorResponse("You can't delete someones ride", $app->response()->getStatus()));
			return $app->response()->setBody($string);
		}
		
		if($ride){
			$app->response()->header("Content-Type", "application/json");
			$app->status(200);
			$string = json_encode($base->standardSuccessResponse("true", 200));
			return $app->response()->setBody($string);
		}
		
		$app->response()->header("Content-Type", "application/json");
		$app->status(500);
		$string =  json_encode($base->standardErrorResponse("An error has occured", $app->response()->getStatus()));
		return $app->response()->setBody($string);
		
	}
);

// patch routes


$app->run();
