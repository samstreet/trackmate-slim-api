<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Controller;


use Slim\Http\Request;
use Slim\Http\Response;
use Trackmate\Interfaces\Controllers\ICrud;

class UserController extends BaseController implements ICrud
{
    public function index(Request $request, Response $response)
    {
        die(var_dump($this));
    }
    
    public function create(Request $request, Response $response)
    {
    }
    
    public function save(Request $request, Response $response)
    {
    }
    
    public function delete(Request $request, Response $response)
    {
    }
    
    public function update(Request $request, Response $response)
    {
    }
    
    public function fetch(Request $request, Response $response)
    {
    }
}