<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Controller;


use Slim\Http\Request;
use Slim\Http\Response;
use Trackmate\Interfaces\Controllers\ICrud;

class UserController extends BaseController implements ICrud
{
	public function index(Request $request, Response $response){
		die(var_dump($this->getUserService()));
	}
	
	public function create(Request $request, Response $response){}
	
	public function save(Request $request, Response $response){}
	
	public function delete(Request $request, Response $response){}
	
	public function update(Request $request, Response $response){}
	
	public function fetch(Request $request, Response $response){}
}