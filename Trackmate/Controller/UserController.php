<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Controller;


use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends BaseController
{
	public function index(Request $request, Response $response){
		die(var_dump($this->get("user")));
	}
}