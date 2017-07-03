<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Controller;


class AuthController extends BaseController
{
	public function authenticate(Request $request, Response $response){
	
//		$app->request()->headers->set("Accept", "application/json");
//		$base = new BaseService();
//		$postData = json_decode($app->request()->getBody(), true);
//
//		$login = $base->getDatabaseService()->authenticate($postData);
//		if($login){
//			$app->response()->header("Content-Type", "application/json");
//			$app->status(200);
//			//$data = array("user" => $login['data']);
//			$string = json_encode($base->standardSuccessResponse("true", 200, $login['data']));// return a response object.
//			return $app->response()->setBody($string);
//		}
//
//		$app->response()->header("Content-Type", "application/json");
//		$app->status(401);
//		$string =  json_encode($base->standardErrorResponse("Authentication failed", 500));
//		return $app->response()->setBody($string);
	
	}
	
	public function refresh(Request $request, Response $response){}
}