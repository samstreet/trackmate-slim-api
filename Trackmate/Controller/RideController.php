<?php
/**
 * @author Sam Street <samstreet.dev@gmail.com>
 */

namespace Trackmate\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Trackmate\Interfaces\Controllers\ICRUD;
use NilPortugues\Api\Problem\ApiProblemResponse;

class RideController implements ICRUD
{
    public function create(Request $request, Response $response)
    {
        die("lols");
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